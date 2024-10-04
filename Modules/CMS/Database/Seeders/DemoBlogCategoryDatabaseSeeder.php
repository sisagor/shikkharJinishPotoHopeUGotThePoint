<?php

namespace Modules\CMS\Database\Seeders;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
                'name' => "Mathematics",
                'details' => "Negative",
                'status' => 1,
            ]);

            DB::table('blog_categories')->insert([
                'name' => "Bangla",
                'details' => "Bangla",
                'status' => 1,
            ]);

            DB::table('blog_categories')->insert([
                'name' => "Physics",
                'details' => "Physics",
                'status' => 1,
            ]);



        } catch (\Exception $exception) {

            Log::error("BLog Categories Type Seeding Error!");
            Log::info(get_exception_message($exception));
        }
    }
}