<?php

namespace Modules\Organization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Organization\Entities\Department;
use Modules\Organization\Entities\Designation;


class DemoOrganizationDatabaseSeeder extends Seeder
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
            $department1 = DB::table('departments')->insertGetId([
                'com_id' => 1,
                'name' => 'Software Department',
                'details' => "This is Software department",
                'status' => Department::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            $department2 = DB::table('departments')->insertGetId([
                'com_id' => 1,
                'name' => 'Accounts Department',
                'details' => "This is Accounts department",
                'status' => Department::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('designations')->insertGetId([
                'com_id' => 1,
                'department_id' => $department2,
                'name' => 'Accounts Designations',
                'details' => "This is Accounts Designation",
                'status' => Designation::STATUS_ACTIVE,
                'created_at' => now(),
            ]);
            DB::table('designations')->insertGetId([
                'com_id' => 1,
                'department_id' => $department1,
                'name' => 'Software Engineers',
                'details' => "This is Software Engineers Designation",
                'status' => Designation::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

        }catch (\Exception $exception){
            Log::error("Demo organization create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
