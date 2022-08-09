<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Settings\Entities\LeaveType;
use Illuminate\Contracts\Support\Renderable;
use Yajra\DataTables\Facades\DataTables;
use Modules\Settings\Http\Requests\LeaveTypeCreateRequest;
use Modules\Settings\Http\Requests\LeaveTypeUpdateRequest;


class LeaveTypeController extends Controller
{
    protected $leaveType;

    public function __construct(LeaveType $leaveType)
    {
        $this->leaveType = $leaveType;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(! $request->ajax()){
            return  view('settings::leaveType.index');
        }

        if ($request->get('type') == "active") {

            $data = $this->leaveType->commonScope();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button($row, 'modal') . trash_button($row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash") {

            $data = $this->leaveType->commonScope()->onlyTrashed();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button($row) . delete_button($row);
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
        set_action('componentSettings.leaveType.store');
        set_action_title('new_leave_type');
        $leaveType = [];

        return view('settings::leaveType.newEdit', compact('leaveType'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(LeaveTypeCreateRequest $request): RedirectResponse
    {
        if ($this->leaveType->create($request->validated())) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.leave_type')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.leave_type')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.leave_type')]));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(LeaveType $leaveType): Renderable
    {
        set_action('componentSettings.leaveType.update', $leaveType);
        set_action_title('edit_leave_type');
        return view('settings::leaveType.newEdit', compact('leaveType'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(LeaveTypeUpdateRequest $request, LeaveType $leaveType): RedirectResponse
    {
        if ($leaveType->update($request->validated())) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.leave_type')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.leave_type')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.leave_type')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(LeaveType $leaveType): RedirectResponse
    {
        if ($leaveType->delete()) {
            sendActivityNotification(trans('msg.noty.soft_delete', ['model' => trans('model.leave_type')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.leave_type')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.leave_type')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($leaveType): RedirectResponse
    {
        if (LeaveType::onlyTrashed()->find($leaveType)->restore()) {

            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.leave_type')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.leave_type')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.leave_type')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($leaveType): RedirectResponse
    {
        if (LeaveType::onlyTrashed()->find($leaveType)->forceDelete()) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.leave_type')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.leave_type')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.leave_type')]));

    }

}
