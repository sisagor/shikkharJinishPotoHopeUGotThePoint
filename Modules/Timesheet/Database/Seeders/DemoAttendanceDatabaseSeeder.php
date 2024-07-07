<?php

namespace Modules\Timesheet\Database\Seeders;

use App\Models\RootModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Holiday;
use Modules\Timesheet\Entities\LeaveApplication;

class DemoAttendanceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        try {

            $employees = DB::table('employees')->select('id', 'employee_index', 'first_name', 'last_name')->get();

            $periods = Carbon::now()->subMonths(5)->monthsUntil(Carbon::now()->subMonth(1)->endOfMonth());

            //$holiday = Holiday::where('holiday_month', 01)->where('holiday_year', '2022')->get();

            //dd($holiday);


            foreach ($periods as $period) {

                $days = Carbon::create($period->startOfMonth())->daysUntil($period->endOfMonth());

                $employees->map(function ($employee) use ($days) {

                    foreach ($days as $day) {

                        $leaveCheck = LeaveApplication::where('approval_status', RootModel::APPROVAL_STATUS_APPROVED)
                            ->where('start_date', '<=', $day->format('Y-m-d'))
                            ->where('end_date', '>=', $day->format('Y-m-d'))
                            ->where('employee_id', $employee->id)
                            ->count();

                        if ($day->format('D') !== "Fri" && ! $leaveCheck) {

                            DB::table('attendances')->insert([
                                'com_id' => 1,
                                'branch_id' => ($employee->id % 2 !== 0) ? 1 : null,
                                'employee_id' => $employee->id,
                                'checkin_time' => $day->startOfDay()->addHours(8)->format('Y-m-d H:i:s'),
                                'checkout_time' => $day->startOfDay()->addHours(16)->format('Y-m-d H:i:s'),
                                'attendance_date' => $day->format('Y-m-d'),
                                'working_hour' => 8,
                                'overtime' => 0,
                                'late' => 0,
                                'status' => 1,
                                'created_at' => $day->format('Y-m-d'),
                                'updated_at' => $day->format('Y-m-d'),
                            ]);
                        }
                    }

                });
            }


        } catch (\Exception $exception) {
            dd($exception);
            Log::error("Demo Attendance create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
