<?php

namespace Modules\Settings\Http\Controllers;


use Illuminate\Http\Request;
use Modules\CMS\Entities\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\BlogDetails;
use Modules\Settings\Http\Requests\BlogCategoryCreateRequest;
use Yajra\DataTables\Facades\DataTables;
use Modules\Settings\Entities\BlogCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\CMS\Http\Requests\BlogCreateRequest;
use Modules\CMS\Repositories\BlogRepositoryInterface;


class BlogCategoryController extends Controller
{
    protected $repo;

    public function __construct(BlogRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function index(Request $request)
    {

        if (! $request->ajax())
        {
            return view('settings::blogCategory.index');
        }

        $data = $this->repo->index($request);

        if ($request->get('type') == "active")
        {

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('details', function ($row){
                    return substr(json_decode($row->details), 0, 500);
                })
                ->editColumn('interview_time', function ($row){
                    return \Carbon\Carbon::parse( $row->interview_time)->format('H:i:s A');
                })
                ->editColumn('interviewers', function ($row){
                    $interviewers = '<ul>';
                    foreach ($row->interviewers as $interviewer){
                        $interviewers .='<li>'. $interviewer->name .'</li>';
                    }
                    $interviewers .= '</ul>';
                    return $interviewers;
                })
                ->addColumn('action', function ($row) {
                    return view_button('cms.blog.view', $row). edit_button('cms.blog.edit', $row, "modal") . trash_button('cms.blog.trash', $row);
                })
                ->rawColumns(['status', 'action', 'details', 'interviewers'])
                ->make(true);
        }

        if ($request->get('type') == "trash")
        {

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('interview_time', function ($row){
                    return \Carbon\Carbon::parse( $row->interview_time)->format('H:i:s A');
                })
                ->editColumn('details', function ($row){
                    return substr(json_decode($row->details), 0, 500);
                })
                ->editColumn('interviewers', function ($row){
                    $interviewers = '<ul>';
                    foreach ($row->interviewers as $interviewer){
                        $interviewers .='<li>'. $interviewer->name .'</li>';
                    }
                    $interviewers .= '</ul>';
                    return $interviewers;
                })
                ->addColumn('action', function ($row) {
                    return restore_button('cms.blog.restore', $row) . delete_button('cms.blog.delete', $row);
                })
                ->rawColumns(['status', 'action', 'details', 'interviewers'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action_title('new_blog_category');
        set_action('componentSettings.blogCategory.store');
        return view('settings::blogCategory.new');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogCreateRequest $request)
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(JobInterview $interview)
    {
        return view('settings::blogCategory.show', compact('interview'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(BlogCategory $category)
    {
        set_action_title('edit_job');
        set_action('cms.blog.update', $category);
        $category = $this->repo->getJobs();

        return view('settings::blogCategory.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogCategoryCreateRequest $request, BlogCategory $category)
    {
        if ($this->repo->update($request, $category)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(BlogCategory $category)
    {
        if ($category->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore(int $id)
    {
        if ($this->repo->restore($id)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if ($this->repo->destroyTrash($id)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.blog_category')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.blog_category')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.blog_category')]))->withInput();
    }

    /**
     * End section job posting
     */
}
