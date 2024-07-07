<?php

namespace Modules\Payroll\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Payroll\Entities\SalaryStructure;


class DemoSalaryStructureComponentDatabaseSeeder extends Seeder
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
            DB::table('salary_structures')->insert([
                'com_id' => 1,
                'name' => 'Mobile Allowance',
                'type' => SalaryStructure::TYPE_ADD,
                'status' => SalaryStructure::STATUS_ACTIVE,
                'created_at' => now(),
            ]);
            DB::table('salary_structures')->insert([
                'com_id' => 1,
                'name' => 'House rent',
                'type' => SalaryStructure::TYPE_ADD,
                'status' => SalaryStructure::STATUS_ACTIVE,
                'created_at' => now(),
            ]);
            DB::table('salary_structures')->insert([
                'com_id' => 1,
                'name' => 'Medical Allowance',
                'type' => SalaryStructure::TYPE_ADD,
                'status' => SalaryStructure::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('salary_structures')->insert([
                'com_id' => 1,
                'name' => 'Travel Allowance',
                'type' => SalaryStructure::TYPE_ADD,
                'status' => SalaryStructure::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('salary_structures')->insert([
                'com_id' => 1,
                'name' => 'Late deduction',
                'type' => SalaryStructure::TYPE_DEDUCT,
                'status' => SalaryStructure::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

            DB::table('salary_structures')->insert([
                'com_id' => 1,
                'name' => 'Overtime',
                'type' => SalaryStructure::TYPE_OVERTIME,
                'status' => SalaryStructure::STATUS_ACTIVE,
                'created_at' => now(),
            ]);

        } catch (\Exception $exception) {
            Log::error("Salary structure component create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
