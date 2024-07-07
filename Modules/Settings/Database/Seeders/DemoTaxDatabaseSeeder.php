<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;


class DemoTaxDatabaseSeeder extends Seeder
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

            DB::table('taxes')->insert([
                'com_id' => 1,
                'eligible_amount' => 1000,
                'tax' => 3,
                'status' => 1,
            ]);

            DB::table('taxes')->insert([
                'com_id' => 1,
                'eligible_amount' => 10000,
                'tax' => 2,
                'status' => 1,
            ]);


        } catch (\Exception $exception) {

            Log::error("Taxes create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
