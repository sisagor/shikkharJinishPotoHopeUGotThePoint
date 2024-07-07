<?php

namespace Modules\Settings\Database\Seeders;

use Carbon\Carbon;
use App\Models\RootModel;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;


class DemoHolidaysDatabaseSeeder extends Seeder
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

            $periods = Carbon::now()->subMonths(12)->monthsUntil(Carbon::now()->subMonth());
            foreach ($periods as $period) {

                $days = Carbon::create($period->startOfMonth())->daysUntil($period->endOfMonth());

                foreach ($days as $day) {
                    if ($day->format('D') == "Fri") {
                        DB::table('holidays')->insert([
                            'com_id' => 1,
                            'occasion' => "Friday",
                            'start_date' => $day->format('Y-m-d'),
                            'end_date' => $day->format('Y-m-d'),
                            'days' => 1,
                            'holiday_year' => $day->format('Y'),
                            'holiday_month' => $day->format('m'),
                            'status' => RootModel::STATUS_ACTIVE,
                        ]);
                    }
                }
            }

        } catch (\Exception $exception) {

            Log::error("Holidays create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
