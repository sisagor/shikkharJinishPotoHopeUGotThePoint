<?php

namespace Modules\Timesheet\Console;

use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\Holiday;
use Modules\Settings\Entities\LeaveType;
use Modules\Timesheet\Entities\Attendance;
use Modules\Timesheet\Entities\AttendanceLog;
use Modules\Timesheet\Entities\LeaveApplication;


class CreateAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:create-att';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate attendance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        //Company attendance
        $companies = Company::select('id')->where('status', RootModel::STATUS_ACTIVE)->get();

        foreach ($companies as $company) {
            $this->createAttendance($company->id);
        }

        //Branch attendances
        $branches = Branch::select('id', 'com_id')->where('status', RootModel::STATUS_ACTIVE)->get();

        foreach ($branches as $branch) {
            $this->createAttendance($branch->com_id, $branch->id);
        }

        $this->info("Attendance created successfully!");
    }

    //Create Attendance
    protected function createAttendance ($comId, $branchId = null){

        try {

            DB::beginTransaction();

            $attendances = AttendanceLog::select(AttendanceLog::$fetch)
                ->where('status', RootModel::STATUS_INACTIVE)
                ->where('com_id', $comId)
                ->where('branch_id', $branchId)
                ->orderBy('punch_time', 'asc')
                ->get();

            $employeeId = [];
            $punchDate = [];

            foreach ($attendances as $att)
            {
                $emp = Employee::with('shift:id,working_hour,start_time,end_time')
                    ->with(['company' => function($com){
                        $com->with('settings:id,com_id,allow_overtime')
                            ->select('id');
                    }])
                    ->select('shift_id', 'id', 'com_id', 'branch_id')
                    ->where('id', $att->employee_id)
                    ->where('com_id', $att->com_id)
                    ->where('branch_id', $att->branch_id ?? null)
                    ->first();

                //get employee
                $employeeId[] = $att->employee_id;
                $punchDate[] = Carbon::parse($att->punch_time)->format('Y-m-d');

                if (empty($emp->shift))
                {
                    continue;
                }

                //skip attendance if it has the holiday or leave application approved;
                if ($this->checkHoliday($comId, Carbon::parse($att->punch_time)->format('Y-m-d'))){
                    continue;
                }

                if ($this->checkLeave($att->employee_id, Carbon::parse($att->punch_time)->format('Y-m-d'),  $comId)){
                    continue;
                }

                //If night shift
                $workingHours = (int)(str_contains($emp->shift->working_hour, '.') ? (explode('.', $emp->shift->working_hour))[0] : 0);
                $workingMinutes = (int)(str_contains($emp->shift->working_hour, '.') ? (explode('.', $emp->shift->working_hour))[1] : 0);
                //attendance date will be start Date;
                $shiftDate = Carbon::parse($att->punch_time)->subHours($workingHours)->subMinutes($workingMinutes)->format('Y-m-d');

                //Check if already Exist
                $exist = Attendance::where('employee_id', $att->employee_id)
                    ->where('com_id', $att->com_id)
                    ->where('branch_id', $att->branch_id ?? null)
                    ->where(function ($date)use($att, $shiftDate){
                        $date->where('attendance_date', Carbon::parse($att->punch_time)->format('Y-m-d'))
                            ->orwhere('attendance_date', $shiftDate);
                    })
                    ->first();



                //if exist system will update attendance;
                if ($exist)
                {
                    //dd($exist);
                    //if status absent will update status and checkin time;
                    if ($exist->status == RootModel::ABSENT)
                    {
                        DB::table('attendances')
                            ->where('id', $exist->id)
                            ->update([
                                'device_ip' => $att->device_ip,
                                'checkin_time' => $att->punch_time,
                                'status' => RootModel::PRESENT,
                                'updated_at' => Carbon::now(),
                            ]);
                    }
                    else
                    {
                        if ($exist->checkin_time)
                        {

                            //if present this will update checkout time and calculate overtime and late:
                            $overTimeLate = $this->getOvertimeLate($exist->checkin_time, $att->punch_time, $emp);
                            //Log::error("attendance has". $check);

                            DB::table('attendances')
                                ->where('id', $exist->id)
                                ->update([
                                    'device_ip' => $att->device_ip,
                                    'checkout_time' => $att->punch_time,
                                    'overtime' => $overTimeLate['overtime'],
                                    'late' => $overTimeLate['late'],
                                    'working_hour' => $overTimeLate['workingHour'],
                                    'updated_at' => Carbon::now()
                                ]);
                        }
                    }
                }
                else
                {
                    //If not exist in attendance system will create new one:
                    //Log::error("Not attendance has");
                    DB::table('attendances')->insert([
                        'com_id' => $att->com_id,
                        'branch_id' => $att->branch_id,
                        'device_ip' => $att->device_ip,
                        'employee_id' => $att->employee_id,
                        'attendance_date' => Carbon::parse($att->punch_time)->format('Y-m-d'),
                        'checkin_time' => $att->punch_time,
                        'status' => RootModel::PRESENT,
                        'created_at' => Carbon::now(),
                    ]);
                }

                //Update attendance_log table so next time this data will not fatched:
                DB::table('attendance_log')
                    ->where('id', $att->id)
                    ->update(['status' => RootModel::STATUS_ACTIVE, 'updated_at' => Carbon::now()]);
            }

            //Create Absent Data:
            if (count($attendances)) {
                $this->createAbsent($employeeId, $punchDate, $comId, $branchId);
            }


            DB::commit();
        }
        catch (\Exception $exception) {

            DB::rollBack();
            Log::error("Create Attendance Error!");
            Log::info(get_exception_message($exception));
        }
    }



    /*get late*/
    private function getOvertimeLate($checkinTime, $checkoutTime, $emp){

        $overtime = 0;
        $late = 0;

        $checkin = Carbon::parse($checkinTime);
        $checkout = Carbon::parse($checkoutTime);

        $shiftStartTime = Carbon::parse($checkinTime)->startOfDay()
            ->addHours(Carbon::parse($emp->shift->start_time)->format('H'))
            ->addMinutes(Carbon::parse($emp->shift->start_time)->format('i'));

        $shiftEndTime = Carbon::parse($checkinTime)->startOfDay()
            ->addHours(Carbon::parse($emp->shift->end_time)->format('H'))
            ->addMinutes(Carbon::parse($emp->shift->end_time)->format('i'));

        // var_dump($checkin->format('y-m-d H:i'));
        //var_dump($checkout->format('y-m-d H:i'));
        $workingHour = $checkin->diffInSeconds($checkout);

        if ($checkin->greaterThan($shiftStartTime)){
            $late = $shiftStartTime->diffInSeconds($checkin);
        }

        if ($checkout->lessThan($shiftEndTime)){
            $late += $checkout->diffInSeconds($shiftEndTime);
        }

        //Branch employee
        if ($emp->branch && $emp->branch->settings->allow_overtime){

            if ($workingHour > convert_time_to_second($emp->shift->working_hour)){
                $overtime = gmdate('H.i', ($workingHour - convert_time_to_second($emp->shift->working_hour)));
            }
        }

        //Company employee:
        if ($emp->company && $emp->company->settings->allow_overtime){
            //dd($diff);
            if ($workingHour > convert_time_to_second($emp->shift->working_hour)){
                $overtime = gmdate('H.i', ($workingHour - convert_time_to_second($emp->shift->working_hour)));
            }
        }

        return ['overtime' => $overtime, 'late' => gmdate('H.i', $late), 'workingHour' => gmdate('H.i', $workingHour)];
    }



    /** this function will create the absent attendance log in attendance table*/
    private function createAbsent($empIds, $punchDate, $comId, $branchId = null){


        $emp = Employee::active()
            ->whereNotIn('id', array_values($empIds))
            ->where('com_id', $comId);
            $emp = ($branchId ? $emp->where('branch_id', $branchId) : $emp->whereNull('branch_id'));
            $emp = $emp->where('branch_id', $branchId)
            ->select('id', 'com_id', 'branch_id')
            ->get();

        $count = 0;

        return $emp->map(function ($item) use($comId, $branchId, $punchDate, $count){
            $punchTime = $punchDate[$count];

            $check = DB::table('attendances')
                ->where('com_id', $comId);
                $check = ($branchId ? $check->where('branch_id', $branchId) : $check->whereNull('branch_id'));
                $check = $check->where('employee_id', $item->id)
                ->where('employee_id', $item->id)
                ->where('attendance_date', $punchTime)
                ->count();


            $leave = LeaveApplication::with(['leaveType' => function($type){
                    $type->where('type', LeaveType::PAID_LEAVE);
                 }])
                ->where('approval_status', RootModel::APPROVAL_STATUS_APPROVED)
                ->where('com_id', $comId);
                $leave = ($branchId ? $leave->where('branch_id', $branchId) : $leave->whereNull('branch_id'));
                $leave = $leave->where('employee_id', $item->id)
                ->where('start_date', '<=', $punchTime)
                ->where('end_date', '=>', $punchTime)
                ->count();

                //Log::info($leave);

            if ($check < 1 && $leave < 1)
            {
                DB::table('attendances')->insert([
                    'com_id' => $item->com_id,
                    'branch_id' => $item->branch_id,
                    'employee_id' => $item->id,
                    'attendance_date' => $punchTime,
                    'status' => RootModel::ABSENT,
                    'created_at' => Carbon::now(),
                ]);
            }
            $count++;
        });
    }

    private function checkLeave($empId, $date, $comId){

        $leave = LeaveApplication::where('approval_status', RootModel::APPROVAL_STATUS_APPROVED)
            ->where('com_id', $comId)
            ->where('employee_id', $empId)
            ->where('start_date', '<=', $date)
            ->where('end_date', '=>', $date)
            ->count();

        return $leave;
    }


    private function checkHoliday($comId, $date){
        return Holiday::where('com_id', $comId)
            ->where('start_date', '<=', $date)
            ->where('end_date', '=>', $date)
            ->count();
    }


}
