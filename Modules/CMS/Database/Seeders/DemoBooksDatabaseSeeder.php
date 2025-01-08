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


class DemoBooksDatabaseSeeder extends Seeder
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


            for($i = 1; $i < 11; $i++)
            {

                DB::table('books')->insert([
                    'url' => $faker->url,
                    //'image' => $faker->image(public_path().'/images/demo/'),
                    'order' => $i,
                    'status' =>1,
                    'view' =>$i,
                    'created_by' =>2,
                ]);
            }


        } catch (\Exception $exception) {

            Log::error("job application create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
