<?php

namespace Modules\Timesheet\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\Holiday;
use Modules\Settings\Entities\LeaveType;
use Modules\Timesheet\Jobs\TimesheetJob;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Organization\Entities\LeavePolicy;
use Modules\Timesheet\Entities\LeaveApplication;
use Modules\Timesheet\Http\Requests\LeaveCreateRequest;
use Modules\Timesheet\Notifications\LeaveRequestApproved;
use Modules\Timesheet\Notifications\LeaveRequestRejected;
use Modules\Timesheet\Repositories\LeaveRepositoryInterface;


class LeaveController extends Controller
{
    private $repository;

    public function __construct(LeaveRepositoryInterface $repository)
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
            return view('timesheet::leave.index');
        }

        $table =  DataTables::of($this->repository->pending($request))
            ->addIndexColumn();

            if(! is_employee()) {
                $table->addColumn('action', function ($row) {
                    return view_button('timesheet.leave.view', $row->id);
                });
            }

        return $table->editColumn('approval_status', function ($row) {
            return get_approval_status($row->approval_status);
        })
        ->make(true);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function approvedApplications(Request $request)
    {
        if (! $request->ajax()) {
            return view('timesheet::leave.approved');
        }
        $data = $this->repository->approved($request);

        return DataTables::of($data)
            ->addIndexColumn()
            /* ->addColumn('action', function ($row) {
                 return view_button($row->id, 'modal');
             })*/
            ->editColumn('approval_status', function ($row) {
                return get_approval_status($row->approval_status);
            })
            ->editColumn('approved_by', function ($row) {
                return get_created_by($row->approved_by);
            })
            ->make(true);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function rejectedApplication(Request $request)
    {
        if (! $request->ajax()) {
            return view('timesheet::leave.rejected');
        }

        $data = $this->repository->rejected($request);

        return DataTables::of($data)
            ->addIndexColumn()
            /* ->addColumn('action', function ($row) {
                 return view_button($row->id, 'modal');
             })*/
            ->editColumn('approval_status', function ($row) {
                return get_approval_status($row->approval_status);
            })
            ->editColumn('approved_by', function ($row) {
                return get_created_by($row->approved_by);
            })
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        set_action('timesheet.leave.store');
        set_action_title('new_leave_application');

        return view('timesheet::leave.new');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(LeaveCreateRequest $request): RedirectResponse
    {
        if (is_employee()) {
            $request->merge(['employee_id' => Auth::user()->employee_id]);
        }

        //check if leave applicable:
        if (! $this->checkLeaveApplyAt($request)){
            return redirect()->back();
        }

        //check available leave:
        $check = $this->checkAvailableLeave($request);
        if ($check[0] == false){
            return redirect()->back()->with('error', 'Leave days has to be less then or equal to ' . ($check[1]));
        }
        //check holidays
       /* if(! $this->checkHolidays($request)) {
            return redirect()->back()->with('warning', 'Leave can\'t apply within holidays');
        }*/

        $exist = LeaveApplication::where('employee_id', $request->get('employee_id'))
            ->where(function ($item) use($request){
                $item->where('start_date', $request->get('start_date'))->orWhere('end_date', $request->get('start_date'));
            })
            ->where(function ($item) use($request){
                $item->where('start_date', $request->get('end_date'))->orWhere('end_date', $request->get('end_date'));
            })
            ->count();

        if ($exist){
            return redirect()->back()->with('error', 'Leave application with same date already exist');
        }

        $store = $this->repository->store($request);

        if ($store) {
            #send activity notification
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.leave_application')]));

            return redirect()->route('timesheet.leaves')->with('success', trans('msg.create_success', ['model' => trans('model.leave_application')]));
        }

        return redirect()->route('timesheet.leaves')->with('error', trans('msg.create_failed', ['model' => trans('model.leave_application')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(LeaveApplication $leave)
    {
        set_action('timesheet.leave.approve', $leave);
        set_action_title('view_application');
        set_action_button('Approve');
        return view('timesheet::leave.show', compact('leave'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function approve(Request $request, LeaveApplication $leave)
    {
        if ($leave->approval_status == LeaveApplication::APPROVAL_STATUS_APPROVED) {

            return redirect()->route('timesheet.leave.approved')
                ->with('info', trans('msg.already_approved', ['model' => trans('model.leave_application')]));
        }

        $approve = $this->repository->updateApproval($request, $leave);

        if ($approve) {
            if ($request->get('approval_status') == LeaveApplication::APPROVAL_STATUS_APPROVED) {
                //activity notification
                sendActivityNotification(trans('msg.noty.approved', ['model' => trans('model.leave_application')]));

                //Email to employee
                sendEmailNotification(new TimesheetJob(LeaveRequestApproved::class, $leave->employee));
            }

            if ($request->get('approval_status') == LeaveApplication::APPROVAL_STATUS_REJECTED) {
                //activity notification
                sendActivityNotification(trans('msg.noty.rejected', ['model' => trans('model.leave_application')]));

                //Email to employee
                sendEmailNotification(new TimesheetJob(LeaveRequestRejected::class, $leave->employee));

            }

            return redirect()->back()->with('success', trans('msg.approve_success', ['model' => trans('model.leave_application')]));
        }

        return redirect()->back()->with('error', trans('msg.approve_failed', ['model' => trans('model.leave_application')]));
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(LeaveApplication $leave)
    {
        if ($leave->forceDelete()) {
            return redirect()->route('timesheet.leaves')->with('success', trans('msg.delete_success', ['model' => trans('model.leave_application')]));
        }
        //
        return redirect()->route('timesheet.leaves')->with('error', trans('msg.delete_failed', ['model' => trans('model.leave_application')]));
    }


    /**check available leave days for specific type and employee*/
    protected function checkAvailableLeave($request)
    {
        $startDate = Carbon::parse($request->get('start_date'));
        $endDate = Carbon::parse($request->get('end_date'));

        $diff = $startDate->diffInDays($endDate);

        $type = LeaveType::where('id', $request->get('type_id'))->pluck('days')->toArray();

        $leave = LeaveApplication::where('employee_id', $request->get('employee_id'))
            ->where('type_id', $request->get('type_id'))
            ->groupBy('employee_id')->sum('leave_days');

        if ($diff > ($type[0] - $leave)) {
            return [false, ($type[0] - $leave)];
        }

        return [true];
    }


    protected function checkLeaveApplyAt($request){

        $emp = Employee::select('joining_date', 'provision_period', 'leave_policy_id')
            ->with('leavePolicy')
            ->where('id', $request->get('employee_id'))->first();

        if($emp->leavePolicy) {

            if ($emp->leavePolicy->apply_at == LeavePolicy::APPLY_AFTER_PROVISION){

                $provision = Carbon::parse($emp->joinig_date)->addMonths($emp->provision_period);

                if ($provision->greaterThan(Carbon::now())) {
                    Session::flash('warning', 'Leave can be apply after provision period.');
                    return false;
                }

                return true;
            }
            return true;
        }

        Session::flash('warning', 'Finish Employment information setup first.');
        return false;
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function getLeavePolicyByEmployee(Request $request)
    {
        $data = [];
        $employee = Employee::with('leavePolicy:id,type_id')
            ->select('id', 'leave_policy_id')
            ->where('id', $request->get('empId'))
            ->first();


        if (! empty($employee->leavePolicy->type_id)) {

            foreach ($employee->leavePolicy->type_id as $type) {

                array_push($data, ['id' => $type->id, 'name' => $type->name
                    . ' || Available Days : ' . (
                        $type->days - $type->leaveApplications()
                            ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                            ->where('employee_id', $request->get('empId'))
                            ->groupBy('employee_id')
                            ->sum('leave_days')
                    )]);
            }
        }

        return \response()->json($data);
    }

    private function checkHolidays(Request $request){

        $periods = CarbonPeriod::create($request->get('start_date'), $request->get('end_date'))->toArray();
        $employee = Employee::where('id', $request->get('employee_id'))->select('id', 'com_id')->first();


        foreach ($periods as $key => $period) {
            //Check if holiday exist:
            $checkHoliday = (bool)Holiday::where('com_id', $employee->com_id)->where('start_date', '<=', $period->format('y-m-d'))
                ->where('end_date', '>=', $period->format('y-m-d'))
                ->count();

            if ($checkHoliday){
                return false;
            }
        }

        return true;
    }


}
