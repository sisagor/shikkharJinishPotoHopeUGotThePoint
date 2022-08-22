<?php

namespace Modules\Recruitment\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Interview;
use Modules\Recruitment\Entities\Job;
use Illuminate\Database\Eloquent\Model;
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

                DB::table('job_interview')->insert([

                    'com_id' => 1,
                    'job_id' => $item->job_id,
                    'job_application_id' => $item->id,
                    'interview_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                    'interviewers' => json_encode([1, 2]),
                    'details' => $faker->paragraph(5),
                    'status' => ($key > 0 ? Interview::STATUS_SCHEDULED : Interview::STATUS_PASS)
                ]);
            }


            $interviews = DB::table('job_interview')->select('job_application_id', 'status')->get();

            foreach ($interviews as $interview){
                if ($interview->status == Interview::STATUS_PASS){
                    $status = ['status' => JobApplication::STATUS_JOB_OFFER];
                }
                if ($interview->status == Interview::STATUS_FAIL){
                    $status = ['status' => JobApplication::STATUS_REJECTED];
                }

                DB::table('job_applications')->where('id', $interview->job_application_id)->update($status);
            }
        }
        catch (\Exception $exception)
        {
            Log::error("job application create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
