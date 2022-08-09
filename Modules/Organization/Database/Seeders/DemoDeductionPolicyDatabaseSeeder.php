<?php

namespace Modules\Organization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Organization\Entities\DeductionPolicy;


class DemoDeductionPolicyDatabaseSeeder extends Seeder
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
            $department = DB::table('attendance_deduction_policies')->insertGetId([
                'com_id' => 1,
                'type' => 'Day',
                'absent' => 3,
                'deduction_amount' => 300,
                'is_percent' => 0,
                'details' => "if employee absent 3 days $300 will deduct from his salary.",
                'status' => DeductionPolicy::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('attendance_deduction_policies')->insertGetId([
                'com_id' => 1,
                'type' => 'Hour',
                'absent' => 3,
                'deduction_amount' => 100,
                'is_percent' => 0,
                'details' => "if employee absent 3 hour $100 will deduct from his salary.",
                'status' => DeductionPolicy::STATUS_ACTIVE,
                'created_at' => now(),
            ]);


        } catch (\Exception $exception) {
            Log::error("Demo Attendance deduction policy create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
