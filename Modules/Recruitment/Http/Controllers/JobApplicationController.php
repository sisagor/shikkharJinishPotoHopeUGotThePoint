<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Recruitment\Entities\Job;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Recruitment\Entities\JobApplication;
use Modules\Recruitment\Repositories\JobApplicationRepositoryInterface;



class JobApplicationController extends Controller
{
    protected $repo;

    public function __construct(JobApplicationRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }


    /**
     * Job applications
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('recruitment::application.index');
        }

        $data = $this->repo->index($request);

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('cover_later', function ($row){
                    return substr(json_decode($row->cover_later), 0, 500);
                })
                ->addColumn('action', function ($row) {
                    return view_button('recruitment.application.view', $row). edit_button('recruitment.application.edit', $row) . trash_button('recruitment.application.trash', $row);
                })
                ->rawColumns(['status', 'action', 'cover_later'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('cover_later', function ($row){
                    return substr(json_decode($row->cover_later), 0, 250);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('recruitment.application.restore', $row) . delete_button('recruitment.application.delete', $row);
                })
                ->rawColumns(['status', 'action', 'cover_later'])
                ->make(true);
        }
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(JobApplication $application)
    {
        return view('recruitment::application.show', compact('application'));
    }


    /**
     * Edit the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JobApplication $application)
    {
        set_action('recruitment.application.update', $application);
        set_action_title('edit_application');
        $jobs = Job::where('status', Job::STATUS_OPEN)->pluck('position', 'id');
        return view('recruitment::application.newEdit', compact('application', 'jobs'));
    }


    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, JobApplication $application)
    {
        if ($this->repo->update($request, $application)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(JobApplication $application)
    {
        if ($application->delete()) {

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
    public function restore(JobApplication $jobApplication)
    {
        if ($this->repo->restore($jobApplication)) {

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
    public function destroy(JobApplication $jobApplication)
    {
        if ($jobApplication->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.job')]))->withInput();
    }

    public function getApplicationByJobId(Request $request)
    {
        $data = $this->repo->findSelect(
            ['job_id' => $request->get('id'), 'status' => JobApplication::STATUS_APPROVED],
            ['id', 'name as text']
        )->toArray();

        if ($data) {
            return response()->json($data);
        }

        return response()->json(['id' => '0', 'text' => 'No candidate found']);
    }


}
