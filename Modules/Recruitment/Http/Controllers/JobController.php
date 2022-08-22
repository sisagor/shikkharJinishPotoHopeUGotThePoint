<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Recruitment\Entities\Job;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Recruitment\Http\Requests\JobCreateRequest;
use Modules\Recruitment\Repositories\JobRepositoryInterface;



class JobController extends Controller
{
    protected $repo;

    public function __construct(JobRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }


    /**
     * section job posting
      */

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('recruitment::jobs.index');
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
                    return view_button('recruitment.jobPosting.view', $row). edit_button('recruitment.jobPosting.edit', $row) . trash_button('recruitment.jobPosting.trash', $row);
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
                    return restore_button('recruitment.jobPosting.restore', $row) . delete_button('recruitment.jobPosting.delete',$row);
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
        set_action_title('new_job');
        set_action('recruitment.jobPosting.store');
        $job = [];
        $jobCategory = $this->repo->jobCategories();
        return view('recruitment::jobs.newEdit', compact('job', 'jobCategory'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(JobCreateRequest $request)
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Job $job)
    {
        return view('recruitment::jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Job $job)
    {
        set_action_title('edit_job');
        set_action('recruitment.jobPosting.update', $job);
        $jobCategory = $this->repo->jobCategories();
        return view('recruitment::jobs.newEdit', compact('job', 'jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(JobCreateRequest $request, Job $job)
    {
        if ($this->repo->update($request, $job)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(Job $job)
    {
        if ($job->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore($loan)
    {
        if ($this->repo->restore($loan)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Job $job)
    {
        if ($job->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * End section job posting
     */
}
