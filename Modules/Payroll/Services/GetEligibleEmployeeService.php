<?php

namespace Modules\Payroll\Services;

use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Support\Facades\DB;
use Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\LeaveType;
use Modules\Timesheet\Entities\Attendance;
use Modules\Timesheet\Entities\LeaveApplication;


class GetEligibleEmployeeService
{
    private $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    /*get employee details*/
    public function employees($employee)
    {
        if (config('company_settings.has_allowances')) {
            $employees = Employee::select([
                'id', 'com_id','branch_id', 'type_id', 'designation_id', 'provision_period', 'basic_salary', 'allow_overtime',
                'overtime_allowance', 'allowance_percent', 'employee_index', 'first_name', 'last_name'
            ])
                ->with(['designation' => function ($designation) {

                    $designation->with(['salaryRule' => function ($rule) {

                        $rule->with(['salaryRuleStructure' => function ($ruleStructure) {

                            $ruleStructure->with(['salaryStructure' => function ($structure) {
                                return $structure->select(['id', 'type', 'name']);
                            }]);

                        }])->select(['id', 'designation_id', 'basic_salary']);

                    }])->select(['id']);
                }])
                ->with(['attendances' => function ($att) {
                    $att->select('employee_id', 'attendance_date', 'working_hour', 'late', 'overtime')
                        ->whereBetween('attendance_date', [
                            $this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')
                        ]);
                }])
                ->with('employeeType:id,allow_company_facility')
                ->withCount(['leaveApplications as leave' => function ($leave) {
                    return $leave->select(DB::raw('SUM(leave_days)'))
                        ->whereHas('leaveType', function ($type){
                            $type->where('type', LeaveType::PAID_LEAVE);
                        })
                        ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                        ->where('start_date', '>=', $this->month->firstOfMonth()->format('Y-m-d'))
                        ->where('end_date', '<=', $this->month->lastOfMonth()->format('Y-m-d'));
                }])
                ->withCount(['attendances as present' => function ($present) {
                    return $present->select(DB::raw('COUNT(id)'))
                        ->whereBetween('attendance_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')])
                        ->where('status', Attendance::PRESENT);
                }])
                ->withCount(['attendances as late' => function ($late) {
                    return $late->select(DB::raw('SUM(late)'))
                        ->whereBetween('attendance_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')]);
                }])
                ->withCount(['attendances as overtime' => function ($overtime) {
                    return $overtime->select(DB::raw('SUM(overtime)'))
                        ->whereBetween('attendance_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')]);
                }])
                ->with(['company' => function ($company) {
                    $company->select('id')
                        ->withCount(['holidays as holidays' => function ($holiday) {
                            return $holiday->select(DB::raw('COUNT(holidays.id)'))
                                ->where('status', RootModel::STATUS_ACTIVE)
                                ->where(function ($date){
                                    $date->whereBetween('start_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')])
                                        ->orWhereBetween('end_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')]);
                                });
                        }]);
                }])
                ->whereNull('is_terminate')
                ->where('joining_date', '<=', Carbon::parse($this->month)->startOfMonth()->subMonth(1)->format('Y-m-d'));
            if ( is_array($employee)){
                $employees->whereIn('id', $employee);
            }
            if (is_company_admin()) {
                $employees->commonScope();
            }

            return $employees->get();
        }

        $employees = Employee::select([
            'id', 'com_id', 'branch_id', 'type_id', 'designation_id', 'provision_period', 'basic_salary', 'allow_overtime',
            'overtime_allowance', 'allowance_percent', 'employee_index', 'first_name', 'last_name'
        ])
            ->with(['attendances' => function ($att) {
                $att->select('employee_id', 'attendance_date', 'working_hour', 'late', 'overtime')
                    ->whereBetween('attendance_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')]);
            }])
            ->with('employeeType:id,allow_company_facility')
            ->withCount(['leaveApplications as leave' => function ($leave) {
                return $leave->select(DB::raw('SUM(leave_days)'))
                    ->whereHas('leaveType', function ($type){
                        $type->where('type', LeaveType::PAID_LEAVE);
                    })
                    ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                    ->where('start_date', '>=', $this->month->firstOfMonth()->format('Y-m-d'))
                    ->where('end_date', '<=', $this->month->lastOfMonth()->format('Y-m-d'));
            }])
            ->withCount(['attendances as present' => function ($present) {
                return $present->select(DB::raw('COUNT(id)'))
                    ->whereBetween('attendance_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')])
                    ->where('status', Attendance::PRESENT);
            }])
            ->withCount(['attendances as late' => function ($late) {
                return $late->select(DB::raw('SUM(late)'))
                    ->whereBetween('attendance_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')]);
            }])
            ->withCount(['attendances as overtime' => function ($overtime) {
                return $overtime->select(DB::raw('SUM(overtime)'))
                    ->whereBetween('attendance_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')]);
            }])
            ->with(['company' => function ($company) {
                $company->select('id')
                    ->withCount(['holidays as holidays' => function ($holiday) {
                        return $holiday->select(DB::raw('SUM(holidays.days)'))
                            ->where('status', RootModel::STATUS_ACTIVE)
                            ->where(function ($date){
                                $date->whereBetween('start_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')])
                                    ->orWhereBetween('end_date', [$this->month->firstOfMonth()->format('Y-m-d'), $this->month->lastOfMonth()->format('Y-m-d')]);
                            });
                    }]);
            }])
            ->whereNull('is_terminate')
            ->where('joining_date', '<=', Carbon::parse($this->month)->startOfMonth()->subMonth(1)->format('Y-m-d'));

        if (is_array($employee)){
            $employees->whereIn('id', $employee);
        }
        if (is_company_admin()) {
            $employees->commonScope();
        }

        return $employees->get();
    }

}
