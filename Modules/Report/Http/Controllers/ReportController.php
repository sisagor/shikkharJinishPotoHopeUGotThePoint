<?php

namespace Modules\Report\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Modules\Timesheet\Entities\LeaveApplication;
use Modules\Report\Repositories\ReportRepositoryInterface;


class ReportController extends Controller
{
    private $repository;

    public function __construct(ReportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Attendance report
     */
    public function attendance(Request $request)
    {
        if (! $request->ajax()) {
            return view('report::attendance');
        }

        $data =  $this->repository->attendanceReport($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('checkin_time', function ($row) {
                return ($row->checkin_time) ? date('h:i A', strtotime($row->checkin_time)) : null;
            })
            ->editColumn('checkout_time', function ($row) {
                return ($row->checkout_time) ? date('h:i A', strtotime($row->checkout_time)) : null;
            })
            ->editColumn('status', function ($row) {
                return attendance_status($row->status, 1);
            })
            ->rawColumns(['status'])
            ->make(true);
    }


    /**
     * Attendance report Month Wise
     */
    public function attendanceMonthWise(Request $request)
    {
        $month = (request()->filled('month') ? request()->get('month') : \Carbon\Carbon::now()->format('Y-m'));
        $days = \Carbon\Carbon::parse($month)->daysInMonth;

        //dd($this->repository->attendanceMonthWiseReport($request, $month)->first());

        if (! $request->ajax()) {
            return view('report::attendanceMonthWise', compact('days'));
        }


        $data =  $this->repository->attendanceMonthWiseReport($request, $month);


        $table = DataTables::of($data)
            ->addColumn('hidden', function ($row){

                $holidays = [];
                $leaveCount = 0;
                $holidayCount = 0;
                $leaves = [];
                $attendances = [];

                if (! empty($row->company->holidays)) {
                    foreach ($row->company->holidays as $key => $holiday) {

                        $periods = CarbonPeriod::since($holiday->start_date)->until($holiday->end_date);

                        foreach ($periods as $period) {
                            array_push($holidays, $period->format('Y-m-d'));
                            $holidayCount += 1;
                        }
                    }
                }

                if (! empty($row->leaveApplications)) {
                    foreach ($row->leaveApplications as $leave) {

                        $periods = CarbonPeriod::since($leave->start_date)->until($leave->end_date);

                        foreach ($periods as $period) {
                            array_push($leaves, $period->format('Y-m-d'));
                            $leaveCount += 1;
                            if (in_array($period->format('Y-m-d'), $holidays)){
                                $holidayCount -= 1;
                            }
                        }
                    }
                }

                if (! empty($row->attendances)) {
                    foreach ($row->attendances as $attendance) {
                        array_push($attendances, ['date' => $attendance->attendance_date, 'status' => $attendance->status]);
                    }
                }

                Session::put('holidayCount', $holidayCount);
                Session::put('leaveCount', $leaveCount);
                Session::put('holidays', $holidays);
                Session::put('leaves', $leaves);
                Session::put('attendances', $attendances);

            });



        for ($i = 0; $i < $days; $i++) {

            $table->addColumn($i, function ($row) use($i, $month) {

                $date = Carbon::parse($month)->addDays($i)->format('Y-m-d');

                $status = null;

                //dd(implode(',', \session('attendances')));
                $present =  false;
                $absent =  false;

                foreach (\session('attendances') as $att){

                    if ($date == $att['date'] && $att['status'] == RootModel::PRESENT){
                        $present = true;
                    }
                    if ($date == $att['date'] && $att['status'] == RootModel::ABSENT){
                        $absent = true;
                    }
                }

                if (in_array($date, \session('holidays'))){
                    $status = config('report.attendance_status.holiday');
                }
                if ($present){
                    $status = config('report.attendance_status.present');
                }
                if ($absent){
                    $status = config('report.attendance_status.absent');
                }
                if (in_array($date, \session('leaves'))){
                    $status = config('report.attendance_status.leave');
                }



                //dd($row->attendances[$i]);
                //var_dump($status);
                return $status;
            });
        }

        $table->addColumn('leave_holiday', function ($row){
            return (\session('holidayCount') + \session('leaveCount'));
        });

        return $table->make(true);
    }


    /**
     * salary report
     */
    public function salary(Request $request)
    {
        if (! $request->ajax()) {
            return view('report::salary');
        }

        $data = $this->repository->salaries($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->removeColumn('id')
            ->editColumn('is_paid', function ($row) {
                return salary_paid_status($row->is_paid);
            })
            ->escapeColumns('is_paid')
            ->editColumn('other_allowance', function ($row) {
                return get_formatted_currency($row->other_allowance, 2);
            })
            ->editColumn('other_deduction', function ($row) {
                return get_formatted_currency($row->other_deduction, 2);
            })
            ->editColumn('total', function ($row) {
                return get_formatted_currency($row->total, 2);
            })
            ->editColumn('basic_salary', function ($row) {
                return get_formatted_currency($row->basic_salary, 2);
            })
            ->editColumn('paid_amount', function ($row) {
                return get_formatted_currency($row->paid_amount, 2);
            })
            ->editColumn('due_amount', function ($row) {
                return get_formatted_currency($row->due_amount, 2);
            })
            ->editColumn('month', function ($row) {
                return (Carbon::parse($row->month))->format('F-Y');
            })
            /* ->addColumn('action', function ($row) {
                 $payment = has_permission('export') && $row->is_paid != Salary::IS_NOT_PAID ?
                     '<a href="javascript:void(0)" data-link="' . route('payroll.salary.payslip', $row) . '" class="ajax-modal-btn btn btn-info">
                         <i class="fa fa-file-pdf-o"></i>
                     </a>'
                     : '';
                 return $payment;
             })*/
            ->make(true);
    }

    /**
     * Leaves report
     */
    public function leave(Request $request)
    {
        if (! $request->ajax()) {
            return view('report::leave');
        }

        $data =  $this->repository->leaves($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('approval_status', function ($row) {
                return get_approval_status($row->approval_status);
            })
            ->editColumn('approved_by', function ($row) {
                return get_created_by($row->approved_by);
            })
            ->make(true);
    }


    public function viewLeave(LeaveApplication $leave)
    {
        set_action('timesheet.leave.approve', $leave);
        set_action_title('view_application');
        return view('timesheet::leave.show', compact('leave'));
    }


}
