<?php

namespace Modules\CMS\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Modules\CMS\Entities\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\BlogCategory;


class DemoBlogDatabaseSeeder extends Seeder
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

            $faker = Factory::create();

            $category = BlogCategory::all();

            foreach($category as $key => $cat){

                DB::table('blogs')->insert([
                    'blog_category_id' => $cat->id,
                    'name' => $faker->name,
                    'order' => $key,
                    'status' =>1
                ]);

            }


        } catch (\Exception $exception) {

            Log::error("job application create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
