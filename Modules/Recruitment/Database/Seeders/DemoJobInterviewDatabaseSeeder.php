<?php

namespace Modules\Recruitment\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Job;
use Illuminate\Database\Eloquent\Model;
use Modules\Recruitment\Entities\JobInterview;
use Modules\Recruitment\Entities\JobApplication;


class DemoJobInterviewDatabaseSeeder extends Seeder
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
            //$jobs = Job::where('status', Job::STATUS_OPEN)->get();
            $jobs = DB::table('job_applications')->select('id', 'job_id')->where('status', JobApplication::STATUS_INTERVIEW)->get();

            foreach ($jobs as $key => $item){

                DB::table('job_interviews')->insert([
                    'com_id' => 1,
                    'job_id' => $item->job_id,
                    'job_application_id' => $item->id,
                    'interview_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                    //'interviewers' => [1, 2],
                    'address' => $faker->address(),
                    'details' => json_encode($faker->paragraph(5)),
                    'status' => ($key > 0 ? JobInterview::STATUS_SCHEDULED : JobInterview::STATUS_PASS)
                ]);
            }
        }
        catch (\Exception $exception)
        {
            Log::error("job Interview create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
