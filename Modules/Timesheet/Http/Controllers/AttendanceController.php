<?php

namespace Modules\Timesheet\Http\Controllers;

use Mapper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Entities\Shift;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Timesheet\Entities\Attendance;
use Illuminate\Contracts\Support\Renderable;
use Modules\Timesheet\Entities\AttendanceLog;
use Modules\Timesheet\Http\Requests\AttendanceCreateRequest;
use Modules\Timesheet\Repositories\AttendanceRepositoryInterface;


class AttendanceController extends Controller
{
    private $repository;

    public function __construct(AttendanceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if (! $request->ajax()) {
            return view('timesheet::attendance.index');
        }

        $data = $this->repository->attendances($request);

        //end Branch Filter
        return DataTables::of($data)
            ->addIndexColumn()
            //->setTotalRecords(get_total_count())
            ->editColumn('checkin_time', function ($row) {
                return ($row->checkin_time) ? date('h:i A', strtotime($row->checkin_time)) : null;
            })
            ->editColumn('checkout_time', function ($row) {
                return ($row->checkout_time) ? date('h:i A', strtotime($row->checkout_time)) : null;
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function punchLog(Request $request)
    {
        $attType = (is_branch_group() ? config('branch_settings.attendance') : config('company_settings.attendance'));

        if (! $request->ajax()) {
            return view('timesheet::attendance.punchLog', compact('attType'));
        }

        $data = $this->repository->punchLog($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('punch_time', function ($row) {
                return ($row->punch_time) ? date('h:i A', strtotime($row->punch_time)) : null;
            })
            ->addColumn('date', function ($row) {
                return ($row->punch_time) ? date('Y-m-d', strtotime($row->punch_time)) : null;
            })
            ->addColumn('actions', function ($row) {
                if ($row->latitude && $row->longitude && has_permission('timesheet.attendance.view') && ! is_employee())
                {
                    return  '<a href="' . route('timesheet.attendance.view', $row) . '" target="_blank"><i class="fa fa-map-o"></i></a>';
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function absent(Request $request)
    {
        if (! $request->ajax()) {
            return view('timesheet::attendance.absent');
        }

        $data = $this->repository->absents($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row){
                return attendance_status($row->status);
            })
            ->rawColumns(['status'])
            ->make(true);
    }


    /**
     *  get on leave employee data
     * @param Request $request
     * @return RedirectResponse
     */
    public function onLeave(Request $request)
    {
        if (! $request->ajax()){
            return view('timesheet::attendance.onLeave');
        }

        $data = $this->repository->getOnLeave($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('approved_by', function ($row){
                return get_approved_by($row->approved_by);
            })
            ->make(true);
    }


    /**
     * checkIn
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        set_action('timesheet.attendance.store');
        set_action_title('create_attendance');

        if (is_employee()){

            $shift = Shift::whereHas('employee', function ($emp){
                $emp->where('id', Auth::user()->employee_id);
            })->select('id','name','start_time','end_time')->first();

            if (! $shift){
                redirect()->back()->with('warning', trans('msg.not_found', ['model' => trans('model.shift')]));
            }

            return view('timesheet::attendance.checkinEmp', compact('shift'));
        }

        return view('timesheet::attendance.checkin');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(AttendanceCreateRequest $request): RedirectResponse
    {
        $store = $this->repository->store($request);

        if ($store) {

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.attendance')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.attendance')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(AttendanceLog $attendance)
    {
        Mapper::map($attendance->latitude, $attendance->longitude);
        // Mapper::marker();

        return view('timesheet::attendance.map');
    }


    /*checkout*/
    public function edit($attendance): Renderable
    {
        $att = $this->repository->edit($attendance);
        set_action('timesheet.attendance.update', $att);
        set_action_title('checkout');

        return view('timesheet::attendance.checkout', compact('att'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Attendance $attendance)
    {
        $delete = $attendance->forceDelete();

        if ($delete) {

            return redirect()->route('timesheet.attendances')->with('success', trans('msg.delete_success', ['model' => trans('model.attendance')]));
        }

        return redirect()->route('timesheet.attendances')->with('error', trans('msg.delete_failed', ['model' => trans('model.attendance')]));
    }
}
