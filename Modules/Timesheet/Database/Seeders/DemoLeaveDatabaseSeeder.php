<?php

namespace Modules\Timesheet\Database\Seeders;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class DemoLeaveDatabaseSeeder extends Seeder
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

            $periods = Carbon::now()->subMonths(5)->monthsUntil(Carbon::now()->subMonth());

            $employees = DB::table('employees')
                ->select('id', 'employee_index', 'first_name', 'last_name')
                ->get();

            foreach ($periods as $period) {

                $employees->map(function ($employee) use ($period) {

                    $startDate = Carbon::create($period->endOfMonth())->subDays(2);
                    $endDate = Carbon::create($period->endOfMonth());

                    $datePeriod = CarbonPeriod::create($startDate, $endDate);

                    $dates = [];

                    foreach ($datePeriod as $date){
                        $dates[] = $date->format('Y-m-d');
                    }

                   DB::table('leave_applications')->insert([
                        'com_id' => 1,
                        'branch_id' => ($employee->id % 2 !== 0) ? 1 : null,
                        'leave_days' => ((int)$startDate->diffInDays($endDate) + 1),
                        'employee_id' => $employee->id,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'details' => "demo leave for days",
                        'approval_status' => ($employee->id % 2 !== 0) ? 1 : 0,
                        'type_id' => 1,
                        'created_at' => $startDate,
                        'updated_at' => $endDate,
                    ]);
                });
            }

        } catch (\Exception $exception) {
            dd($exception);
            Log::error("Demo Attendance create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
