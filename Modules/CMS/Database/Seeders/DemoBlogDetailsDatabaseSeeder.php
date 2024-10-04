<?php

namespace Modules\CMS\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\CMS\Entities\Blog;
use Modules\CMS\Entities\BlogDetails;


class DemoBlogDetailsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        try
        {
            $faker = Factory::create();

            $blogs = DB::table('blogs')->get();

            foreach ($blogs as $key => $blog) {

                DB::table('blog_details')->insert([
                    'blog_id' => $blog->id,
                    'details' => $faker->paragraph(),
                    'order' => $key,
                    'status' => 1
                ]);
            }


            $details = BlogDetails::all();
            foreach ($details as $key =>  $detail)
            {
                //$detail->saveImage('cover'.$key+1, 'blog');
            }


        } catch (\Exception $exception) {

            Log::error("Blog Details create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
