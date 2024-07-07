<?php

namespace Modules\Report\Repositories;

use Carbon\Carbon;
use App\Common\Filter;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Payroll\Entities\Salary;
use Modules\Employee\Entities\Employee;
use App\Repositories\EloquentRepository;
use Modules\Timesheet\Entities\LeaveApplication;
use Modules\Payroll\Repositories\PayrollRepositoryInterface;
use Modules\Timesheet\Repositories\LeaveRepositoryInterface;
use Modules\Timesheet\Repositories\AttendanceRepositoryInterface;


class ReportRepository extends EloquentRepository implements ReportRepositoryInterface
{
    private PayrollRepositoryInterface $payroll;
    private LeaveRepositoryInterface $leave;
    private AttendanceRepositoryInterface $attendance;

    public function __construct(AttendanceRepositoryInterface $attendanceRepository, PayrollRepositoryInterface $payrollRepository, LeaveRepositoryInterface $leaveRepository)
    {
        $this->payroll = $payrollRepository;
        $this->attendance = $attendanceRepository;
        $this->leave = $leaveRepository;
    }

    /**
     * Get all Leave Applications
     */
    public function attendanceReport(Request $request)
    {
        $query = $this->attendance->attendance();
        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'attendances.com_id', 'branch_id' => 'attendances.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->statusFilter(['status' => 'attendances.status'])
            ->dateFilter(['from_date' => 'attendances.attendance_date', 'to_date'=> 'attendances.attendance_date'])
            ->execute();
    }

    /**
     * Get all Leave Applications
     */
    public function attendanceMonthWiseReport(Request $request, $month)
    {
        $query = Employee::mine()//->where('id', 1)
            ->with(['attendances' => function($att) use($month){
                $att->orderBy('attendance_date', 'asc')
                    ->whereRaw("DATE_FORMAT(attendance_date, '%Y-%m') = ?", [$month])
                    ->select('employee_id', 'status', 'attendance_date');
            }])
            ->with(['company' => function($com) use($month){
                $com->with(['holidays' => function($att) use($month){
                    $att->where('status', RootModel::STATUS_ACTIVE)
                        ->where('holiday_year', Carbon::parse($month)->format('Y'))
                        ->where('holiday_month', Carbon::parse($month)->format('m'))
                        ->select('com_id', 'status', 'start_date', 'end_date');
                }]);
            }])
            ->with(['leaveApplications' => function($leave) use($month){
                $leave->select('employee_id', 'start_date', 'end_date')
                    ->whereRaw("DATE_FORMAT(start_date, '%Y-%m') = ?", [$month])
                    ->orWhereRaw("DATE_FORMAT(end_date, '%Y-%m') = ?", [$month])
                    ->where('approval_status', RootModel::APPROVAL_STATUS_APPROVED);
            }])
            ->withCount(['attendances as present' => function ($present) use($month) {
                return $present->select(DB::raw('COUNT(id)'))
                    ->whereRaw("DATE_FORMAT(attendance_date, '%Y-%m') = ?", [$month])
                    ->where('status', RootModel::PRESENT);
            }])
            ->withCount(['attendances as absent' => function($absent) use($month) {
                return $absent->select(DB::raw('COUNT(id)'))
                    ->whereRaw("DATE_FORMAT(attendance_date, '%Y-%m') = ?", [$month])
                    ->where('status', RootModel::ABSENT);
            }]);

        return (is_employee() ? $query->where('id', is_employee()): $query);
    }



    /** get salaries*/
    public function salaries(Request $request)
    {
        $query = $this->payroll->salaries()->where('approval_status', Salary::APPROVAL_STATUS_APPROVED);

        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'salaries.com_id', 'branch_id' => 'salaries.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->monthFilter(['month' => 'salaries.month'])
            ->execute();
    }


    /** leave report*/
    public function leaves(Request $request)
    {
        $query = $this->leave->leaveApplications()->where('approval_status', '!=', LeaveApplication::APPROVAL_STATUS_PENDING);
        $query = ($request->filled('status')? $query->where('approval_status', $request->get('status')) : $query);
        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'leave_applications.com_id', 'branch_id' => 'leave_applications.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'leave_applications.start_date', 'to_date'=> 'leave_applications.start_date'])
            ->execute();
    }


}
