<?php

namespace Modules\CMS\Http\Controllers;


use Illuminate\Http\Request;
use Modules\CMS\Entities\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\BlogDetails;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Settings\Entities\BlogCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\CMS\Http\Requests\BlogCreateRequest;
use Modules\CMS\Repositories\BlogRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
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
            return view('cms::blog.index');
        }

        $data = $this->repo->index($request);

        //dd($data);

        if ($request->get('type') == "active")
        {

            return DataTables::of($data)
                ->addIndexColumn()
                // ->editColumn('details', function ($row){
                //     return substr(json_decode($row->details), 0, 500);
                // })
                ->editColumn('status', function ($row)
                {
                    return get_status($row->status);
                })
                ->editColumn('created_at', function ($row){
                    return \Carbon\Carbon::parse( $row->created_at)->format('H:i:s A');
                })
                ->editColumn('details', function ($row){
                    $details = '<ul>';
                    foreach ($row->details as $detail){
                        $details .='<li>'. $detail->details .'</li>';
                    }
                    $details .= '</ul>';
                    return $details;
                })
                ->addColumn('action', function ($row) {
                    return view_button('cms.blog.view', $row). edit_button('cms.blog.edit', $row, "modal") . trash_button('cms.blog.trash', $row);
                })
                ->rawColumns(['status', 'action', 'details'])
                ->make(true);
        }

        if ($request->get('type') == "trash")
        {

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('created_at', function ($row){
                    return \Carbon\Carbon::parse( $row->interview_time)->format('H:i:s A');
                })
                // ->editColumn('details', function ($row){
                //     return substr(json_decode($row->details), 0, 500);
                // })
                ->editColumn('status', function ($row)
                {
                    return get_status($row->status);
                })
                ->editColumn('details', function ($row){
                    $details = '<ul>';
                    foreach ($row->details as $detail){
                        $details .='<li>'. $detail->details .'</li>';
                    }
                    $details .= '</ul>';
                    return $details;
                })
                ->addColumn('action', function ($row) {
                    return restore_button('cms.blog.restore', $row) . delete_button('cms.blog.delete', $row);
                })
                ->rawColumns(['status', 'action', 'details'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action_title('new_blog');
        set_action('cms.blog.store');
        $blog = [];
        $categories = BlogCategory::active()->pluck('name', 'id');
        return view('cms::blog.new', compact('blog', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(BlogCreateRequest $request) : RedirectResponse
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.blog')]));

            return redirect()->route('cms.blogs')->with('success', trans('msg.create_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(JobInterview $interview)
    {
        return view('cms::blog.show', compact('interview'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JobInterview $interview)
    {
        set_action_title('edit_job');
        set_action('cms.blog.update', $interview);
        $jobs = $this->repo->getJobs();

        return view('cms::blog.newEdit', compact('jobs', 'interview'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(InterviewCreateRequest $request, JobInterview $interview)
    {
        if ($this->repo->update($request, $interview)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.blog')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(JobInterview $interview)
    {
        if ($interview->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.blog')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore($interview)
    {
        if ($this->repo->restore($interview)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.blog')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($interview)
    {
        if ($this->repo->destroyTrash($interview)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.blog')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.blog')]))->withInput();
    }

    /**
     * End section job posting
     */
}
