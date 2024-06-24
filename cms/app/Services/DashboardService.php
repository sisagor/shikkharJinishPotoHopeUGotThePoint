<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Payroll\Entities\Salary;
use Modules\Settings\Entities\Holiday;
use Modules\Employee\Entities\Employee;
use Modules\Timesheet\Entities\Attendance;
use Modules\Organization\Entities\LeavePolicy;
use Modules\Timesheet\Entities\LeaveApplication;

class DashboardService
{

    protected function getFilter($query, $data = []){
        $query = (is_company_group() ? $query->where($data['com_id'], com_id()) : $query);
        $query = (is_department_admin() ? $query->where($data['department_id'], is_department_admin()) : $query);
        return $query;
    }

    //Attendance Average last year
    public function getAttendanceAverage(Request $request)
    {
        $data = [
            'levels' => [],
            'present' => [],
            'absent' => [],
            'holiday' => [],
            'leave' => [],
        ];

        $months = Carbon::now()->subMonth(11)->monthsUntil(Carbon::now());

        foreach ($months as $month) {

            //Attendance average;
            $present = ($this->attAvgQuery($month))->where('attendances.status', RootModel::PRESENT)->get()->avg('total_counts');

            //Absent Average;
            $absent =($this->attAvgQuery($month))->where('attendances.status', RootModel::ABSENT)->get()->avg('total_counts');

            //Holidays
            $holiday = (float)(Holiday::commonScope()->select('days')->where(function ($date) use ($month) {
                $date->whereBetween('start_date', [$month->startOfMonth()->format('Y-m-d'), $month->endOfMonth()->format('Y-m-d')])
                    ->orwhereBetween('end_date',  [$month->startOfMonth()->format('Y-m-d'), $month->endOfMonth()->format('Y-m-d')]);
            })->get()->avg('days'));

            //Leave average
            $leave = DB::table('leave_applications')
                ->join('employees', 'employees.id', 'leave_applications.employee_id');
                $leave = $this->getFilter($leave, [
                    'com_id' => 'leave_applications.com_id',
                    'department_id' => 'employees.department_id',
                ]);
                $leave = $leave->where(function ($date) use ($month) {
                    $date->whereBetween('leave_applications.start_date', [$month->startOfMonth()->format('Y-m-d'), $month->endOfMonth()->format('Y-m-d')])
                        ->orwhereBetween('leave_applications.end_date',  [$month->startOfMonth()->format('Y-m-d'), $month->endOfMonth()->format('Y-m-d')]);
                })
                ->where('leave_applications.approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                ->groupBy('leave_applications.employee_id')
                ->selectRaw('SUM(leave_applications.leave_days) as total_count')
                ->get()->avg('total_count');

            $data['levels'][] = $month->format('M-Y');
            $data['present'][] = $present ? number_format($present, 2) : 0;
            $data['absent'][] = $absent ? number_format($absent, 2) : 0;
            $data['holiday'][] = $holiday ?? 0;
            $data['leave'][] = $leave ?? 0;
        }

        return array_values($data);

    }


    /*today attendances */
    public function getTodayAttendances(Request $request)
    {
        $data = [];
        $today = Carbon::now()->format('Y-m-d');
        //Employees
        $employee = DB::table('employees');
        $employee = $this->getFilter($employee, [
            'com_id' => 'com_id',
            'department_id' => 'department_id',
        ]);
        $employee = $employee->count('id');

        //Present Employee
        $present = ($this->attTodayQuery($today))->where('attendances.status', RootModel::PRESENT)->count('attendances.employee_id');

        //Absent employee
        $absent =($this->attTodayQuery($today))->where('attendances.status', RootModel::ABSENT)->count('attendances.employee_id');

        //Leave count
        $leave = DB::table('leave_applications')
             ->join('employees', 'employees.id', 'leave_applications.employee_id')
            ->where('leave_applications.approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
            ->where('leave_applications.start_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('leave_applications.end_date', '>=', Carbon::now()->format('Y-m-d'));
            $leave = $this->getFilter($leave, [
                'com_id' => 'leave_applications.com_id',
                'department_id' => 'employees.department_id',
            ]);
            $leave = $leave->distinct()
            ->count('leave_applications.employee_id');


        $data[] = ['value' => $employee, 'name' => "employee"];
        $data[] = ['value' => $present, 'name' => "Present"];
        $data[] = ['value' => $leave, 'name' => "Leaves"];
        $data[] = ['value' => $absent, 'name' => "Absent"];

        return array_values($data);

    }


    /*salary data*/
    public function getSalaries(Request $request)
    {
        $data = [
            'levels' => [],
            'salary' => [],
            'paid' => [],
            'due' => [],
        ];

        $periods = Carbon::now()->subMonths(11)->monthsUntil(Carbon::now());

        foreach ($periods as $key => $period){

            $result = Salary::mine()->select(
                DB::raw('SUM(total) as salary'),
                DB::raw('SUM(paid_amount) as paid'),
                DB::raw('SUM(due_amount) as due'),
            )
                ->where('month', 'LIKE', '%'.$period->format('Y-m').'%')
                ->with(['employee' => function($emp){
                    return (Auth::user()->department_id ? $emp->select('id')->where('department_id', Auth::user()->department_id) : null );
                }])
                ->groupBy('month')
                ->first();

            array_push($data['levels'], $period->format('M-Y'));

            if ($result){

                $data['salary'][] = round($result->salary, 2);
                $data['paid'][] = round($result->paid, 2);
                $data['due'][] = round($result->due, 2);
            }
            else
            {
                $data['salary'][] = 0;
                $data['paid'][] = 0;
                $data['due'][] = 0;
            }
        }

        return array_values($data);

    }


    /*get holidays */

    public function getHolidays(Request $request)
    {
        $data = [];
        $holidays = Holiday::companyScope()
            ->select('occasion as title', 'start_date', 'end_date')
            ->where(function ($date) use($request){
                $date->whereBetween('start_date',  [$request->get('start'), $request->get('end')])
                    ->orWhereBetween('end_date', [$request->get('start'), $request->get('end')]);
            })
            ->get();

        foreach ($holidays as $holiday){
            $data[] = [
                'title' => $holiday->title,
                'start' => $holiday->start_date,
                'end' => $holiday->end_date
            ];
        }

        return ($data);
    }


    /*gte leave policies*/

    public function getLeavePolicies(Request $request)
    {
        $data = array();

        $leavePolicy = LeavePolicy::commonScope()->select('name', 'type_id')->get();

        $color = ['#da0d68', '#9fe080', '#5470c6', '#4eb849', '#f7a128', '#9fe080', '#e0719c', '#faef07',  '#da1d23', '#c94a44', '#975e6d', '#e0719c', '#dd4c51', '#e62969', '#6569b0', '#a5446f', '#f89a1c', '#f26355'];

        foreach ($leavePolicy as $key =>  $policy) {

            $data[] = [
                'name' => $policy->name,
                'itemStyle' => [
                    'color' => $color[$key]
                ],
                'children' => [],
            ];

            foreach ($policy->type_id as $hop => $type) {

                $data[$key]['children'][] = [
                    'name' => $type->name,
                    'value' => $type->days,
                    'itemStyle' => ['color' => $color[$key] . ($hop + $key)],
                ];
            }
        }

        return $data;

    }


    ///get common query foor Attendancce avg
    private function attAvgQuery($month)
    {
        $attendance = DB::table('attendances')->join('employees', 'employees.id', 'attendances.employee_id');
        $attendance = $this->getFilter($attendance, [
            'com_id' => 'attendances.com_id',
            'department_id' => 'employees.department_id',
        ]);
        return $attendance->whereBetween('attendances.attendance_date',
            [
                $month->startOfMonth()->format('Y-m-d'),
                $month->endOfMonth()->format('Y-m-d')
            ])
            ->selectRaw('count(attendances.employee_id) as total_counts')
            ->groupBy('attendances.employee_id')
            ->orderBy('attendances.employee_id');
    }


    ///get common query foor Attendancce avg
    private function attTodayQuery($today)
    {
        $att = DB::table('attendances')
            ->join('employees', 'employees.id', 'attendances.employee_id')
            ->where('attendances.attendance_date', $today)
            ->distinct();
        return $this->getFilter($att, [
            'com_id' => 'attendances.com_id',
            'department_id' => 'employees.department_id',
        ]);
    }






}
