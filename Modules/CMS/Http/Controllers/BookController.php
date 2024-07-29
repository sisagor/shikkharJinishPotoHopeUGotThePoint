<?php

namespace Modules\CMS\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Book;
use Modules\CMS\Http\Requests\BookCreateRequest;
use Modules\CMS\Http\Requests\BookUpdateRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\CMS\Http\Requests\JobCreateRequest;


class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('cms::book.index');
        }

        $data = Book::query();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row){
                    $image = '<img  style="height=100px; width:100px" src="'.get_storage_file_url(optional($row->book)->path).'" alt="'.optional($row->book)->name.'">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    return edit_button('cms.book.edit', $row) . trash_button('cms.book.trash', $row);
                })
                ->addColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('image', function ($row){
                    return get_storage_file_url(optional($row->book)->path);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('cms.book.restore', $row) . delete_button('cms.book.delete',$row);
                })
                ->addColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action_title('new_book');
        set_action('cms.book.store');
        return view('cms::book.new');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(BookCreateRequest $request): RedirectResponse
    {
        $unsetImage = $request->validated();
        unset($unsetImage['image']);

        $book = Book::create($unsetImage);

        if ($request->hasFile('image'))
        {
            $book = $book->saveImage($request->file('image'), 'book');
        }

        if ($book)
        {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Book $book)
    {
        return view('cms::book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Book $book)
    {
        set_action_title('edit_book');
        set_action('cms.book.update', $book);
        return view('cms::book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BookUpdateRequest $request, Book $book): RedirectResponse
    {
        $unsetImage = $request->validated();
        unset($unsetImage['image']);

        $book->update($unsetImage);

        if ($request->hasFile('image')){
            $book = $book->updateImage($request->file('image'), 'book');
        }
        if ($book) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(Book $book) : RedirectResponse
    {
        if ($book->delete())
        {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($book) : RedirectResponse
    {
        $book = Book::onlyTrashed()->find($book)->restore();
        if ($book)
        {
            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Book $book) : RedirectResponse
    {
        if ($book->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * End section job posting
     */
}
