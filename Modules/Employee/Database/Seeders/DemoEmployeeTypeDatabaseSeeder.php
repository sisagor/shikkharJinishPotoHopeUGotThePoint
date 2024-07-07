<?php

namespace Modules\Employee\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class DemoEmployeeTypeDatabaseSeeder extends Seeder
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

            DB::beginTransaction();

            DB::table('employee_types')->insert([
                "com_id" => 1,
                "name" => "Permanent",
                "details" =>"Employee type permanent",
                'status' => 1,
                'created_at' => now(),
            ]);

            DB::table('employee_types')->insert([
                "com_id" => 1,
                "name" => "Contractual",
                "details" =>"Employee type contractual",
                'status' => 1,
                'created_at' => now(),
            ]);

            DB::commit();

        }catch (\Exception $exception){

            DB::rollBack();
            Log::error("Employee type Demo create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
