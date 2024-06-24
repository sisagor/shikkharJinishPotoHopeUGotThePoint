<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\CMS\Entities\JobInterview;
use Illuminate\Contracts\Support\Renderable;
use Modules\CMS\Http\Requests\InterviewCreateRequest;
use Modules\CMS\Repositories\InterviewRepositoryInterface;


class InterviewController extends Controller
{
    protected $repo;

    public function __construct(InterviewRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function index(Request $request)
    {

        if (! $request->ajax()){
            return view('cms::interview.index');
        }

        $data = $this->repo->index($request);

        if ($request->get('type') == "active"){

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
                    return view_button('cms.interview.view', $row). edit_button('cms.interview.edit', $row, "modal") . trash_button('cms.interview.trash', $row);
                })
                ->rawColumns(['status', 'action', 'details', 'interviewers'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

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
                    return restore_button('cms.interview.restore', $row) . delete_button('cms.interview.delete', $row);
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
        set_action_title('new_interview');
        set_action('cms.interview.store');
        $interview = [];
        $jobs = $this->repo->getJobs();
        return view('cms::interview.newEdit', compact('interview', 'jobs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(InterviewCreateRequest $request)
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.interview')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.interview')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.interview')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(JobInterview $interview)
    {
        return view('cms::interview.show', compact('interview'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JobInterview $interview)
    {
        set_action_title('edit_job');
        set_action('cms.interview.update', $interview);
        $jobs = $this->repo->getJobs();

        return view('cms::interview.newEdit', compact('jobs', 'interview'));
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

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.interview')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.interview')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.interview')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(JobInterview $interview)
    {
        if ($interview->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.interview')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.interview')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.interview')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore($interview)
    {
        if ($this->repo->restore($interview)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.interview')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.interview')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.interview')]))->withInput();
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

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.interview')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.interview')]))->withInput();
    }

    /**
     * End section job posting
     */
}
