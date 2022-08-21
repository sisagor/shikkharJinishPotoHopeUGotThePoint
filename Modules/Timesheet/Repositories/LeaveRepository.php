<?php

namespace Modules\Timesheet\Repositories;

use App\Common\Filter;
use App\Models\RootModel;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\Employee\Entities\Employee;
use App\Repositories\EloquentRepository;
use Modules\Timesheet\Entities\Attendance;
use Modules\Timesheet\Entities\LeaveApplication;


class LeaveRepository extends EloquentRepository implements LeaveRepositoryInterface
{
    private $model;

    public function __construct(LeaveApplication $leaveApplication)
    {
        $this->model = $leaveApplication;
    }

    /*common Query for leave applications*/
    public function leaveApplications(){
        return LeaveApplication::join('employees', 'employees.id', 'leave_applications.employee_id')
            ->join('leave_types', 'leave_types.id', 'leave_applications.type_id')
            ->select(
                'employees.employee_index',
                'employees.name',
                'leave_types.name as type_name',
                'leave_applications.id',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.details',
                'leave_applications.leave_days',
                'leave_applications.leave_for',
                'leave_applications.leave_hour_date',
                'leave_applications.leave_hour',
                'leave_applications.approval_status',
                'leave_applications.approved_by',
                'leave_applications.created_by',
            );
    }

    /**
     * Get all Leave Applications
     */
    public function pending(Request $request)
    {
        $query = $this->leaveApplications()->where('approval_status', LeaveApplication::APPROVAL_STATUS_PENDING);
        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'leave_applications.com_id', 'branch_id' => 'leave_applications.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'leave_applications.start_date', 'to_date'=> 'leave_applications.end_date'])
            ->execute();
    }


    /**
     * Get approved Leave Applications
     */
    public function approved(Request $request)
    {
        $query = $this->leaveApplications()->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED);
        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'leave_applications.com_id', 'branch_id' => 'leave_applications.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'leave_applications.start_date', 'to_date'=> 'leave_applications.end_date'])
            ->execute();
    }

    /**
     * Get rejected Leave Applications
     */
    public function rejected(Request $request)
    {
        $query = $this->leaveApplications()->where('approval_status', LeaveApplication::APPROVAL_STATUS_REJECTED);
        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'leave_applications.com_id', 'branch_id' => 'leave_applications.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'leave_applications.start_date', 'to_date'=> 'leave_applications.end_date'])
            ->execute();
    }


    /*Store Leave Application*/
    public function store(Request $request): bool
    {
        $employee = Employee::where('id', $request->get('employee_id'))->select('id', 'com_id')->first();
        //return $this->splitApplicationToExcludeHolidays($request);
        try {

            $startDate = Carbon::parse($request->get('start_date'));
            $endDate = Carbon::parse($request->get('end_date'));

            DB::beginTransaction();

            if ($request->get('approval_status') == RootModel::APPROVAL_STATUS_APPROVED) {
                $this->adjustLeaveAbsent($request->get('employee_id'), Carbon::parse($request->get('start_date')), Carbon::parse($request->get('end_date')));
                $createdBy = Auth::id();
                $createdByName = Auth::user()->name;
            }

            $model = $this->model->create([
                'com_id' => $employee->com_id,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'leave_for' => $request->get('leave_for'),
                'leave_hour_date' => $request->get('leave_hour_date'),
                'leave_hour' => $request->get('leave_hour'),
                'leave_days' => ((Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1)),
                'approval_status' => ($request->get('approval_status') ?? 0),
                'type_id' => $request->get('type_id'),
                'employee_id' => $request->get('employee_id'),
                'details' => $request->get('details'),
                'approved_by' => @$createdBy,
                'approved_by_name' => @$createdByName,
            ]);


            if ($request->hasFile('attachment')){
                $model->saveDocument($request->file('attachment'), $employee->id.'_leave_document', 1);
            }

            DB::commit();

        } catch (\Exception $e) {
            //dd($e);
            DB::rollBack();
            Log::error("Leave Applications create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }




    /*Approve Leave application*/
    public function updateApproval(Request $request, LeaveApplication $leave): bool
    {
        try {

            $startDate = Carbon::parse($request->get('start_date'));
            $endDate = Carbon::parse($request->get('end_date'));
            $diff = $startDate->diffInDays($endDate);

            DB::beginTransaction();

            $this->adjustLeaveAbsent($leave->employee_id, $startDate, $endDate);

            $leave->update([
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'leave_days' => ($diff + 1),
                'approval_status' => $request->get('approval_status'),
                'approved_by' => Auth::id(),
                'approved_by_name' => Auth::user()->name,
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Leave application update Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    //Adjust leave and absent
    private function adjustLeaveAbsent($emp, $startDate, $endDate){
        //adjust the leave and absent
        $periods = CarbonPeriod::since($startDate)->until($endDate);

        foreach ($periods as $period){
            Attendance::where('attendance_date', $period->format('Y-m-d'))
                ->where('status', RootModel::ABSENT)
                ->where('employee_id', $emp)
                ->forceDelete();
        }
        //adjust the leave and absent
    }


    /*private function splitApplicationToExcludeHolidays(Request $request): bool
    {
        try {

            $employee = Employee::where('id', $request->get('employee_id'))->select('id', 'com_id')->first();
            $periods = CarbonPeriod::create($request->get('start_date'), $request->get('end_date'))->toArray();
             $months = [];
             $intervals = [];
             foreach ($periods as $key => $period) {

                 if (!in_array($period->format('Y-m'), $months)) {
                     if (count($months) > 0) {
                         $startDate = $period->startOfMonth()->format('Y-m-d');
                     } else {
                         $startDate = $request->get('start_date');
                     }

                     //Push Month
                     $months[] = $period->format('Y-m');

                     if (end($periods)->format('Y-m') == end($months)) {
                         $endDate = $request->get('end_date');
                     } else {
                         $endDate = $period->endOfMonth()->format('Y-m-d');
                     }

                     $intervals[] = ['start' => $startDate, 'end' => $endDate];
                 }

             }


             //Find the holidays through loop every day:
             $intervalsUpdate = [];
             foreach ($intervals as $inta)
             {
                 $intaPeriod = CarbonPeriod::create(Carbon::parse($inta['start']), Carbon::parse($inta['end']));
                 foreach ($intaPeriod as $key => $day)
                 {

                     //var_dump($day->format('Y-m-d'));
                     $checkHoliday = Holiday::where('com_id', $employee->com_id)
                         ->where('start_date', '<=', $day->format('Y-m-d'))
                         ->where('end_date', '>=', $day->format('Y-m-d'))
                         ->count();

                     if ($checkHoliday)
                     {
                         $intervalsUpdate[] = "holiday";
                     }
                     else
                     {
                         $intervalsUpdate[] = $day->format('Y-m-d');
                     }
                 }
             }

             //Split array by given key holiday:
             $count = 0;
             $temp = [];
             foreach ($intervalsUpdate as $key => $item){

                 if ($item != "holiday")
                 {
                    $temp[$count][] = $item;
                 }
                 else{
                     $count++;
                 }
             }

             $intervalDate = [];
             foreach ($temp as $key => $item) {

                 $itemCount = count($item);

                 foreach ($item as $k => $i){
                     if ($k == 0){
                         $intervalDate[$key]['start'] = $i;
                     }
                     if ($k == $itemCount -1){
                         $intervalDate[$key]['end'] = $i;
                     }
                 }
                 //$keyCount
             }

            DB::beginTransaction();

            if ($request->get('approval_status') == RootModel::APPROVAL_STATUS_APPROVED) {
                $this->adjustLeaveAbsent($request->get('employee_id'), Carbon::parse($request->get('start_date')), Carbon::parse($request->get('end_date')));
                $createdBy = Auth::id();
                $createdByName = Auth::user()->name;
            }


            //Split Application to multiple part exclude holidays:
            $model = null;
            foreach ($intervalDate as $item) {
                $model = $this->model->create([
                    'start_date' => $item['start'],
                    'end_date' => $item['end'],
                    'leave_for' => $request->get('leave_for'),
                    'leave_hour_date' => $request->get('leave_hour_date'),
                    'leave_hour' => $request->get('leave_hour'),
                    'leave_days' => ((Carbon::parse($item['start'])->diffInDays(Carbon::parse($item['end'])) + 1)),
                    'approval_status' => $request->get('approval_status'),
                    'type_id' => $request->get('type_id'),
                    'employee_id' => $request->get('employee_id'),
                    'details' => $request->get('details'),
                    'approved_by' => @$createdBy,
                    'approved_by_name' => @$createdByName,
                ]);
            }

            if ($request->hasFile('attachment')){
                $model->saveDocument($request->file('attachment'), $employee->id.'_leave_document', 1);
            }

            DB::commit();

        } catch (\Exception $e) {
            //dd($e);
            DB::rollBack();
            Log::error("Leave Applications create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }*/



}
