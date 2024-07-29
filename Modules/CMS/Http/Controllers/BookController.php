<?php

namespace Modules\CMS\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
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

        $data = $this->repo->jobs($request);

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('details', function ($row){
                    return substr(json_decode($row->details ), 0, 500);
                })
                ->editColumn('requirements', function ($row){
                    return substr(json_decode($row->requirements), 0, 500);
                })
                ->addColumn('action', function ($row) {
                    return view_button('cms.jobPosting.view', $row). edit_button('cms.jobPosting.edit', $row) . trash_button('cms.jobPosting.trash', $row);
                })
                ->rawColumns(['action', 'details', 'requirements'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('details', function ($row){
                    return substr(json_decode($row->details ), 0, 500);
                })
                ->editColumn('requirements', function ($row){
                    return substr(json_decode($row->requirements), 0, 500);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('cms.jobPosting.restore', $row) . delete_button('cms.jobPosting.delete',$row);
                })
                ->rawColumns(['action', 'details', 'requirements'])
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
        $job = [];
        $jobCategory = $this->repo->jobCategories();
        return view('cms::book.newEdit', compact('job', 'jobCategory'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(JobCreateRequest $request)
    {
        if ($this->repo->store($request)) {

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
        set_action_title('edit_job');
        set_action('cms.book.update', $book);


        return view('cms::book.newEdit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(JobCreateRequest $request, Book $book)
    {
        if ($this->repo->update($request, $book)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(Blog $job)
    {
        if ($job->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore($loan)
    {
        if ($this->repo->restore($loan)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Blog $job)
    {
        if ($job->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.book')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.book')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.book')]))->withInput();
    }

    /**
     * End section job posting
     */
}
