<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\EmployeeType;
use Modules\Settings\Entities\Shift;
use Modules\Employee\Entities\Employee;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Http\Requests\ShiftCreateRequest;
use Modules\Settings\Http\Requests\ShiftUpdateRequest;
use Yajra\DataTables\Facades\DataTables;


class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if(! $request->ajax()){
            return view('settings::shift.index');
        }

        if ($request->get('type') == "active"){

            $data  = Shift::commonScope();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('start_time', function ($row) {
                    return  date('h:i:s a', strtotime($row->start_time));
                })
                ->editColumn('end_time', function ($row) {
                    return  date('h:i:s a', strtotime($row->start_time));
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('componentSettings.shift.edit', $row, 'modal') . trash_button('componentSettings.shift.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }


        if ($request->get('type') == "trash"){
            $trash = Shift::commonScope()->onlyTrashed();

            return DataTables::of($trash)
                ->addIndexColumn()
                ->editColumn('start_time', function ($row) {
                    return  date('h:i:s a', strtotime($row->start_time));
                })
                ->editColumn('end_time', function ($row) {
                    return  date('h:i:s a', strtotime($row->start_time));
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('componentSettings.shift.restore', $row) . delete_button('componentSettings.shift.delete', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action('componentSettings.shift.store');
        set_action_title('new_shift');

        $shift = [];

        return view('settings::shift.newEdit', compact('shift'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ShiftCreateRequest $request)
    {
        $start = Carbon::parse($request->get('start_time'));
        $end = Carbon::parse($request->get('end_time'));

        $diff = $start->diff($end);
        //$minutes = $start->diffInMinutes();
        $hour = $diff->h . '.' . $diff->i;

        $create = Shift::create([
            'name' => $request->get('name'),
            'details' => $request->get('details'),
            'start_time' => $start,
            'end_time' => $end,
            'working_hour' => (float)$hour,
            'status' => $request->get('status')
        ]);

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.shift')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.shift')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.shift')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('timesheet::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Shift $shift)
    {
        set_action('componentSettings.shift.update', $shift);
        set_action_title('edit_shift');

        return view('settings::shift.newEdit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ShiftUpdateRequest $request, Shift $shift)
    {
        $start = date('H:i:s', strtotime($request->get('start_time')));
        $end = date('H:i:s', strtotime($request->get('end_time')));

        $update = $shift->update([
            'name' => $request->get('name'),
            'details' => $request->get('details'),
            'start_time' => $start,
            'end_time' => $end,
            'status' => $request->get('status')
        ]);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.shift')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.shift')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.shift')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(Shift $shift)
    {
        $delete = $shift->delete();

        if ($delete) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.shift')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.shift')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.shift')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($shift)
    {
        $delete = Shift::onlyTrashed()->find($shift)->forceDelete();

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.shift')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.shift')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.shift')]));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @restore
     */
    public function restore($shift)
    {
        $delete = Shift::onlyTrashed()->find($shift)->restore();

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.shift')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.shift')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.shift')]));
    }


    /**
     * get employee via ajax from throughout the system
     * @param int $id
     * @return Renderable
     */
    public function getShiftViaId(Request $request): JsonResponse
    {
        ///Temporary status inactive: it should be active:
        $shift = Shift::where('id', $request->get('id'))->select('start_time', 'end_time')->first();
        if ($shift) {
            return \response()->json([
                'startTime' => date('h:i A', strtotime($shift->start_time)),
                'endTime' => date('h:i A', strtotime($shift->end_time)),
            ]);
        }

        return \response()->json([]);
    }

    /**
     * get employee via ajax from throughout the system
     * @param int $id
     * @return Renderable
     */
    public function getEmployeeViaShift(Request $request): JsonResponse
    {
        ///Temporary status inactive: it should be active:
        $employee = Employee::active()
            ->companyScope()
            ->branchScope();
            //->where('branch_id', branch_id())
            $employee = (is_department_admin() ? $employee->where('department_id', is_department_admin()) : $employee);
            $employee->where('shift_id', $request->get('id'))
            ->select('id', DB::raw('CONCAT(first_name, " ", last_name) as text'));
            if (is_employee()){
                $employee->where('id', is_employee());
            }
            $employee = $employee->get();

        if ($employee) {
            return response()->json($employee);
        }

        return response()->json(['id' => '0', 'text' => trans('msg.not_found', ['model' => trans('model.employee')])]);
    }


}
