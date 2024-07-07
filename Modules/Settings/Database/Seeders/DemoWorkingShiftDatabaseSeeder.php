<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Shift;


class DemoWorkingShiftDatabaseSeeder extends Seeder
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
            //Type Add
            DB::table('shifts')->insert([
                'com_id' => 1,
                'name' => 'Morning Shift',
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'working_hour' => 8,
                'details' => "This is morning shift",
                'status' => Shift::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('shifts')->insert([
                'com_id' => 1,
                'name' => 'Evening Shift',
                'start_time' => '16:00:00',
                'end_time' => '24:00:00',
                'working_hour' => 8,
                'details' => "This is evening shift",
                'status' => Shift::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

        } catch (\Exception $exception) {
            Log::error("Demo working shift create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
