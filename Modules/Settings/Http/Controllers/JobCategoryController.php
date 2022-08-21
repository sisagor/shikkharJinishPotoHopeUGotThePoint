<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Settings\Entities\JobCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Http\Requests\JobCategoryCreateRequest;
use Modules\Settings\Http\Requests\JobCategoryUpdateRequest;



class JobCategoryController extends Controller
{
    protected $jobCategory;

    public function __construct(JobCategory $jobCategory)
    {
        $this->jobCategory = $jobCategory;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(! $request->ajax()){
            return  view('settings::jobCategory.index');
        }

        if ($request->get('type') == "active") {

            $data = $this->jobCategory->commonScope();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('componentSettings.jobCategory.edit', $row) . trash_button('componentSettings.jobCategory.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash") {

            $data = $this->jobCategory->commonScope()->onlyTrashed();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('componentSettings.jobCategory.restore', $row) . delete_button('componentSettings.jobCategory.delete', $row);
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
        set_action('componentSettings.jobCategory.store');
        set_action_title('new_job_category');
        $jobCategory = [];

        return view('settings::jobCategory.newEdit', compact('jobCategory'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(JobCategoryCreateRequest $request): RedirectResponse
    {
        if ($this->jobCategory->create($request->validated())) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.job_category')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.job_category')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.job_category')]));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JobCategory $jobCategory): Renderable
    {
        set_action('componentSettings.jobCategory.update', $jobCategory);
        set_action_title('edit_job_category');
        return view('settings::jobCategory.newEdit', compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(JobCategoryUpdateRequest $request, JobCategory $jobCategory): RedirectResponse
    {
        if ($jobCategory->update($request->validated())) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.job_category')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.job_category')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.job_category')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(JobCategory $jobCategory): RedirectResponse
    {
        if ($jobCategory->delete()) {
            sendActivityNotification(trans('msg.noty.soft_delete', ['model' => trans('model.job_category')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.job_category')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.job_category')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($jobCategory): RedirectResponse
    {
        if (JobCategory::onlyTrashed()->find($jobCategory)->restore()) {

            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.job_category')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.job_category')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.job_category')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($jobCategory): RedirectResponse
    {
        if (JobCategory::onlyTrashed()->find($jobCategory)->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.job_category')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.job_category')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.job_category')]));

    }

}
