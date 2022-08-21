<?php

namespace Modules\Timesheet\Repositories;

use App\Models\RootModel;
use Illuminate\Http\Request;
use Modules\Employee\Entities\Employee;
use App\Repositories\EloquentRepository;
use Yajra\DataTables\Facades\DataTables;
use Modules\Timesheet\Entities\Attendance;
use Modules\Timesheet\Entities\AttendanceLog;
use Modules\Timesheet\Entities\LeaveApplication;



class TimesheetRepository extends EloquentRepository implements TimesheetRepositoryInterface
{
    public $model;

    public function __construct(Attendance $attendance)
    {
        $this->model = $attendance;
    }

    ##filter
    public function getFilter($leaves, $request)
    {
        if ($request->filled('employee_id')) {

            $leaves->where('employee_id', $request->get('employee_id'));
        }

        if ($request->filled('month')) {
            $leaves->where('attendance_date', 'LIKE', $request->get('month') . '%');
        }

        return $leaves;
    }

    /**
     * Get all Attendances
     */
    /**
     * Get all Leave Applications
     * This function used in 2 place. timesheet dashboard and employee dashboard
     */
    public function getAttChartData(Request $request)
    {
        $data = [];
        $present = 0;
        $absent = 0;
        $leave = 0;

        $month = $request->get('month') ? $request->get('month') : \Carbon\Carbon::now()->format('Y-m');
        //Employees
        $employeeId = ($request->get('employee_id') ? $request->get('employee_id') : (Employee::mine()->select('id')->first())->id);
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

            //Leave count
            $leave += LeaveApplication::mine()
                ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                ->where(function ($item) use ($month) {
                    $item->where('start_date', 'LIKE', $month . '%')
                        ->orWhere('end_date', 'LIKE', $month . '%');
                })
                ->where('employee_id', $employeeId)
                ->sum('leave_days');

        }

        array_push($data, ['value' => $present, 'name' => "Present"]);
        array_push($data, ['value' => $leave, 'name' => "Leaves"]);
        array_push($data, ['value' => $absent, 'name' => "Absent"]);

        return array_values($data);
    }


}
