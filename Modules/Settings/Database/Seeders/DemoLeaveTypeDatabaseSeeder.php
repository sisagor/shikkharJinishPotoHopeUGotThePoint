<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\LeaveType;


class DemoLeaveTypeDatabaseSeeder extends Seeder
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

            DB::table('leave_types')->insert([
                'com_id' => 1,
                'type' => LeaveType::PAID_LEAVE,
                'days' => 10,
                'name' => 'Sick',
                'details' => "employee will eligible for this when get sick",
                'status' => 1,
            ]);

            DB::table('leave_types')->insert([
                'com_id' => 1,
                'type' => LeaveType::PAID_LEAVE,
                'name' => 'Casual',
                'days' => 10,
                'details' => "employee always eligible fot this",
                'status' => 1,
            ]);

            DB::table('leave_types')->insert([
                'com_id' => 1,
                'type' => LeaveType::PAID_LEAVE,
                'name' => 'Occasion',
                'days' => 10,
                'details' => "employee will eligible for this in specific occasion",
                'status' => 1,
            ]);

            DB::table('leave_types')->insert([
                'com_id' => 1,
                'type' => LeaveType::UNPAID_LEAVE,
                'name' => 'Emergency',
                'days' => 10,
                'details' => "employee will eligible for this in any emergency case",
                'status' => 1,
            ]);

            DB::table('leave_types')->insert([
                'com_id' => 1,
                'type' => LeaveType::PAID_LEAVE,
                'name' => 'Pregnancy',
                'days' => 10,
                'details' => "only women employee will eligible for this in her pregnancy time",
                'status' => 1,
            ]);

        } catch (\Exception $exception) {

            Log::error("settings create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
