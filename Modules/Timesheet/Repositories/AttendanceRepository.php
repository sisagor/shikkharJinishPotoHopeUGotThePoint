<?php

namespace Modules\Timesheet\Repositories;

use App\Common\Filter;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Employee\Entities\Employee;
use App\Repositories\EloquentRepository;
use Modules\Timesheet\Entities\Attendance;
use Stevebauman\Location\Facades\Location;
use Modules\Timesheet\Entities\AttendanceLog;



class AttendanceRepository extends EloquentRepository implements AttendanceRepositoryInterface
{
    private $model;

    public function __construct(Attendance $attendance)
    {
        $this->model = $attendance;
    }

    public function attendance(): \Illuminate\Database\Query\Builder
    {
        return DB::table('attendances')
            ->join('employees', 'attendances.employee_id', 'employees.id')
            ->select([
                'employees.employee_index',
                'employees.first_name',
                'employees.last_name',
                'attendances.status',
                'attendances.attendance_date',
                'attendances.checkin_time',
                'attendances.checkout_time',
                'attendances.working_hour',
                'attendances.late',
                'attendances.device_ip',
                'attendances.overtime'
            ])
            ->orderBy('attendances.attendance_date', 'desc');
    }

    /**
     * Get all punch log
     */
    public function punchLog(Request $request)
    {
        $query = AttendanceLog::join('employees', 'attendance_log.employee_id', 'employees.id')
            ->select([
                'attendance_log.id',
                'employees.employee_index',
                'employees.first_name',
                'employees.last_name',
                'attendance_log.device_ip',
                'attendance_log.punch_time',
                'attendance_log.location',
                'attendance_log.latitude',
                'attendance_log.longitude',
            ])
            //->where('is_present', Attendance::NOT_DONE)
            ->orderBy('attendance_log.punch_time', 'desc');

        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'attendance_log.com_id', 'branch_id' => 'attendance_log.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'attendance_log.punch_time', 'to_date'=> 'attendance_log.punch_time'])
            ->execute();

    }

    /**
     * Get all Attendances
     */
    public function attendances(Request $request): \Illuminate\Database\Query\Builder
    {
        $query = $this->attendance()->where('attendances.status', RootModel::PRESENT);
        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'attendances.com_id', 'branch_id' => 'attendances.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'attendances.attendance_date', 'to_date'=> 'attendances.attendance_date'])
            ->execute();
    }

    /**
     * Get all Absents
     */
    public function absents(Request $request): \Illuminate\Database\Query\Builder
    {
        $query = $this->attendance()->where('attendances.status', RootModel::ABSENT);

        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'attendances.com_id', 'branch_id' => 'attendances.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'attendances.attendance_date', 'to_date'=> 'attendances.attendance_date'])
            ->execute();
    }

    /**
     * Get all on leave employees
     */
    public function getOnLeave(Request $request): \Illuminate\Database\Query\Builder
    {
        $query = DB::table('leave_applications')
            ->leftJoin('leave_types', 'leave_applications.type_id', 'leave_types.id')
            ->leftJoin('employees', 'leave_applications.employee_id', 'employees.id')
            ->select(
                'employees.first_name',
                'employees.last_name',
                'employees.employee_index',
                'leave_types.name as type',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.details',
                'leave_applications.leave_days',
                'leave_applications.approval_status',
                'leave_applications.approved_by'
            )
            ->where('leave_applications.approval_status', RootModel::APPROVAL_STATUS_APPROVED)
            ->orderBy('leave_applications.start_date', 'desc');

        $query = (! $request->filled('from_date') || ! $request->filled('to_date')
            ? $query->where(function ($item){
                $item->where('leave_applications.start_date', '<=', Carbon::today())
                    ->orWhere('leave_applications.end_date', '>=', Carbon::today());
            })
            : $query);

        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'leave_applications.com_id', 'branch_id' => 'leave_applications.branch_id'])
            ->departmentScopeFilter(['department_id' =>'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->dateFilter(['from_date' => 'leave_applications.start_date', 'to_date'=> 'leave_applications.start_date'])
            ->execute();


    }


    //Store group or single Punch
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $checkinTime = Carbon::parse($request->get('punch_time'));
            ///$checkoutTime = Carbon::parse($request->get('checkout_time'));
            $checkinDate = Carbon::parse($request->get('attendance_date'));
            $checkinDateTime = $checkinDate->startOfDay()->addHours($checkinTime->format('H'))->addMinutes($checkinTime->format('i'));

            foreach ($request->get('employee_id') as $id)
            {
                $emp = Employee::select('id', 'com_id', 'branch_id', 'first_name', 'last_name', 'employee_index')->where('id', $id)->first();

                if (! $emp)
                {
                    continue;
                }

                //If admin or officials create punch
                $createData = [
                    'com_id' => $emp->com_id,
                    'location' => ($emp->address() ? $emp->address()->city : null),
                    'branch_id' => $emp->branch_id,
                    'employee_id' => $emp->id,
                    'punch_time' => $checkinDateTime,
                    'status' => RootModel::STATUS_INACTIVE,
                ];

                //if employee punch;
                if (is_employee()){

                   // $position = Location::get($request->ip());
                    $position = Location::get("103.146.92.29");

                    if($position) {

                        $createData = call_user_func('array_merge', $createData, [
                           // 'location' => $position->cityName.' '. $position->postalCode. ' ' . $position->regionName,
                            'device_ip' => $position->ip,
                            'latitude' => $position->latitude,
                            'longitude' => $position->longitude,
                        ]);
                    }
                }
                //Create Attendance log;
                DB::table('attendance_log')->insert($createData);
            }

            //dd("end");
            DB::commit();

        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            //dd($exception);
            Log::error("Attendance Punch Error!");
            Log::info(get_exception_message($exception));

            return false;
        }

        return true;
    }


}
