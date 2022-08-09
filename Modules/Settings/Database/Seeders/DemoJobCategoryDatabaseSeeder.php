<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;


class DemoJobCategoryDatabaseSeeder extends Seeder
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

            DB::table('job_categories')->insert([
                'com_id' => 1,
                'name' => 'Engineering',
                'details' => "Engineering category job will be here",
                'status' => 1,
            ]);

            DB::table('job_categories')->insert([
                'com_id' => 1,
                'name' => 'Accounts',
                'details' => "Accounts category job will be here",
                'status' => 1,
            ]);

            DB::table('job_categories')->insert([
                'com_id' => 1,
                'name' => 'HR',
                'details' => "HR category job will be here",
                'status' => 1,
            ]);

        } catch (\Exception $exception) {

            Log::error("job category create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
