<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Settings\Entities\BlogCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Http\Requests\BlogCategoryCreateRequest;
use Modules\Settings\Http\Requests\BlogCategoryUpdateRequest;



class BlogCategoryController extends Controller
{
    protected $blogCategory;

    public function __construct(BlogCategory $blogCategory)
    {
        $this->blogCategory = $blogCategory;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(! $request->ajax()){
            return  view('settings::blogCategory.index');
        }

        if ($request->get('type') == "active") {

            $data = $this->blogCategory->commonScope();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('componentSettings.blogCategory.edit', $row) . trash_button('componentSettings.blogCategory.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash") {

            $data = $this->blogCategory->commonScope()->onlyTrashed();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('componentSettings.blogCategory.restore', $row) . delete_button('componentSettings.blogCategory.delete', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        set_action('componentSettings.blogCategory.store');
        set_action_title('new_blog_category');
        $blogCategory = [];

        return view('settings::blogCategory.newEdit', compact('blogCategory'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request): RedirectResponse
    {
        if ($this->blogCategory->create($request->validated())) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.blog_category')]));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(BlogCategory $blogCategory): Renderable
    {
        set_action('componentSettings.blogCategory.update', $blogCategory);
        set_action_title('edit_blog_category');
        return view('settings::blogCategory.newEdit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        if ($blogCategory->update($request->validated())) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.blog_category')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(BlogCategory $blogCategory): RedirectResponse
    {
        if ($blogCategory->delete()) {
            sendActivityNotification(trans('msg.noty.soft_delete', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.blog_category')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($blogCategory): RedirectResponse
    {
        if (BlogCategory::onlyTrashed()->find($blogCategory)->restore()) {

            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.blog_category')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($blogCategory): RedirectResponse
    {
        if (BlogCategory::onlyTrashed()->find($blogCategory)->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.blog_category')]));

    }

}
