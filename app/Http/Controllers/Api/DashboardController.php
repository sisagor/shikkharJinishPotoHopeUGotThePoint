<?php

namespace App\Http\Controllers\Api;


use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\Holiday;
use Modules\Timesheet\Entities\Attendance;
use Modules\Timesheet\Entities\LeaveApplication;


class DashboardController extends BaseController
{
    //Attendance and leave summery for current month;
    public function AttSummery(Request $request)
    {
        try {

            $data = [];
            $present = 0;
            $absent = 0;
            $leave = 0;
            $AvailableLeave = 0;
            $holidays = [];

            $month = $request->get('month') ? $request->get('month') : \Carbon\Carbon::now()->format('Y-m');
            //Employees
            $employeeId = Auth::user()->employee_id;
            //Attendance count
            if ($employeeId) {

                $present = Attendance::mine()
                    ->where('attendance_date', 'LIKE', $month . '%')
                    ->where('employee_id', $employeeId)
                    ->where('status', RootModel::PRESENT)
                    ->count('employee_id');

                $absent = Attendance::mine()
                    ->where('attendance_date', 'LIKE', $month . '%')
                    ->where('employee_id', $employeeId)
                    ->where('status', RootModel::ABSENT)
                    ->count('employee_id');

                //Taken Leave count
                $leave = LeaveApplication::mine()
                    ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                    ->where(function ($item) use ($month) {
                        $item->where('start_date', 'LIKE', $month . '%')
                            ->orWhere('end_date', 'LIKE', $month . '%');
                    })
                    ->where('employee_id', $employeeId)
                    ->sum('leave_days');


                //Available Leaves
                $employee = Employee::with('leavePolicy:id,type_id')
                    ->select('id', 'leave_policy_id', 'com_id')
                    ->where('id', $employeeId)
                    ->first();

                if (! empty($employee->leavePolicy->type_id)) {

                    foreach ($employee->leavePolicy->type_id as $type) {

                        $AvailableLeave += ($type->days - $type->leaveApplications()
                                ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                                ->where('employee_id', $employeeId)
                                ->where('type_id', $employeeId)
                                ->groupBy('employee_id')
                                ->sum('leave_days'));
                    }
                }


                //Holidays
                $holidays = Holiday::active()->select('start_date', 'end_date')
                    ->where('start_date', '>=', Carbon::now()->startOfYear()->format('Y-m-d'))
                    ->where('end_date', '<=', Carbon::now()->endOfYear()->format('Y-m-d'))
                    ->where('com_id', $employee->com_id)
                    ->get();

                $holidaysDate = [];
                foreach ($holidays as $holiday){
                    $rang = Carbon::parse($holiday->start_date)->daysUntil(Carbon::parse($holiday->end_date));
                    foreach ($rang as $date){
                        $holidaysDate[] = $date->format('Y-m-d');
                    }
                }
                //End holidays


            }

            array_push($data, ['present' => $present]);
            array_push($data, ['taken_leave' => $leave]);
            array_push($data, ['available_leave' => $AvailableLeave]);
            array_push($data, ['absent' => $absent]);
            array_push($data, ['holidays' => $holidaysDate]);

            return $this->handleResponse($data, 'success');
        }
        catch (\Exception $exception){
            return $this->handleError(get_exception_message($exception), 'failed');
        }

    }


}
