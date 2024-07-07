<?php

namespace Modules\Recruitment\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Recruitment\Entities\Job;


class DemoJobDatabaseSeeder extends Seeder
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

            DB::table('job_postings')->insert([
                'com_id' => 1,
                'category_id' => 1,
                'position' => 'Software Engineer',
                'job_location' => 'dhaka',
                'salary_rang' => "40-60k",
                'details' => json_encode( "is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'requirements' => json_encode("is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'vacancy' => 2,
                'experience' => 2,
                'expire_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'status' => Job::STATUS_OPEN,
            ]);

            DB::table('job_postings')->insert([
                'com_id' => 1,
                'category_id' => 1,
                'position' => 'Junior Software Engineer',
                'job_location' => 'dhaka',
                'salary_rang' => "30-40k",
                'details' => json_encode( "is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'requirements' => json_encode("is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'vacancy' => 2,
                'experience' => 1,
                'expire_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'status' => Job::STATUS_OPEN,
            ]);

            DB::table('job_postings')->insert([
                'com_id' => 1,
                'category_id' => 2,
                'position' => 'Account Manager',
                'job_location' => 'dhaka',
                'salary_rang' => "30-40k",
                'details' => json_encode( "is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'requirements' => json_encode("is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'vacancy' => 2,
                'experience' => 2,
                'expire_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'status' => Job::STATUS_OPEN,
            ]);

            DB::table('job_postings')->insert([
                'com_id' => 1,
                'category_id' => 2,
                'position' => 'Junior Account Manager',
                'job_location' => 'dhaka',
                'salary_rang' => "30-40k",
                'details' => json_encode( "is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'requirements' => json_encode("is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'vacancy' => 2,
                'experience' => 1,
                'expire_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'status' => Job::STATUS_OPEN,
            ]);

            DB::table('job_postings')->insert([
                'com_id' => 1,
                'category_id' => 3,
                'position' => 'HR Manager',
                'job_location' => 'dhaka',
                'salary_rang' => "30-40k",
                'details' => json_encode( "is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'requirements' => json_encode("is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'vacancy' => 2,
                'experience' => 2,
                'expire_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'status' => Job::STATUS_OPEN,
            ]);
            DB::table('job_postings')->insert([
                'com_id' => 1,
                'category_id' => 3,
                'position' => 'Junior HR Manager',
                'job_location' => 'dhaka',
                'salary_rang' => "30-40k",
                'details' => json_encode( "is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'requirements' => json_encode("is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic  is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic"),
                'vacancy' => 2,
                'experience' => 2,
                'expire_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'status' => Job::STATUS_OPEN,
            ]);


        } catch (\Exception $exception) {

            Log::error("job create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
