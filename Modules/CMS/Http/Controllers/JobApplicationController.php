<?php

namespace Modules\CMS\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\CMS\Entities\Blog;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\CMS\Entities\JobApplication;
use Modules\CMS\Repositories\JobApplicationRepositoryInterface;



class JobApplicationController extends Controller
{
    protected $repo;

    public function __construct(JobApplicationRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }


    /**
     * Blog applications
     * @return Renderable | JsonResponse
     */
    public function index(Request $request) : Renderable | JsonResponse
    {
        if (! $request->ajax()){
            return view('cms::application.index');
        }

        $data = $this->repo->index($request);

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('cover_later', function ($row){
                    return substr(json_decode($row->cover_later), 0, 500);
                })
                ->addColumn('action', function ($row) {
                    return view_button('cms.application.view', $row). edit_button('cms.application.edit', $row) . trash_button('cms.application.trash', $row);
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
                    return restore_button('cms.application.restore', $row) . delete_button('cms.application.delete', $row);
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
    public function show(JobApplication $application) : Renderable
    {
        return view('cms::application.show', compact('application'));
    }


    /**
     * Edit the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JobApplication $application) : Renderable
    {
        set_action('cms.application.update', $application);
        set_action_title('edit_application');
        $jobs = Blog::where('status', Blog::STATUS_OPEN)->pluck('position', 'id');
        return view('cms::application.newEdit', compact('application', 'jobs'));
    }


    /**
     * Update the specified resource.
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, JobApplication $application): RedirectResponse
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
     * @return RedirectResponse
     */
    public function trash(JobApplication $application) : RedirectResponse
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
     * @return RedirectResponse
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
     * @return Renderable | RedirectResponse
     */
    public function destroy(JobApplication $jobApplication)
    {
        if ($jobApplication->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function getApplicationByJobId(Request $request)
    {
        $data = JobApplication::where('job_id', $request->get('id'))
            ->where(function($q){
                $q->where('status', JobApplication::STATUS_APPROVED)
                    ->orWhere('status', JobApplication::STATUS_INTERVIEW);
            })
            ->select(['name as text', 'id'])
            ->get()
            ->toArray();

        if ($data) {
            return response()->json($data);
        }

        return response()->json(['id' => '0', 'text' => 'No candidate found']);
    }


}
