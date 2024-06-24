<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;


class DemoBlogCategoryDatabaseSeeder extends Seeder
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

            DB::table('blog_categories')->insert([
                'name' => 'Mathematics',
                'details' => "Mathematics category job will be here",
                'status' => 1,
            ]);

            DB::table('blog_categories')->insert([
                'name' => 'Chemistry',
                'details' => "Chemistry category job will be here",
                'status' => 1,
            ]);

            DB::table('blog_categories')->insert([
                'name' => 'Biology',
                'details' => "Biology category job will be here",
                'status' => 1,
            ]);

        } catch (\Exception $exception) {

            Log::error("Blog category create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
