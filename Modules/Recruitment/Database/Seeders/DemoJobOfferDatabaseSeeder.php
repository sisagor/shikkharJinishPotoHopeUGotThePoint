<?php

namespace Modules\Recruitment\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Job;
use Illuminate\Database\Eloquent\Model;
use Modules\Recruitment\Entities\JobOffer;
use Modules\Recruitment\Entities\JobInterview;
use Modules\Recruitment\Entities\JobApplication;


class DemoJobOfferDatabaseSeeder extends Seeder
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
            $interviews = DB::table('job_interviews')->select('id', 'job_id', 'job_application_id')->where('status', JobInterview::STATUS_PASS)->get();

            foreach ($interviews as $key => $item){

                DB::table('job_offers')->insert([
                    'com_id' => 1,
                    'job_id' => $item->job_id,
                    'job_application_id' => $item->job_application_id,
                    'title' => $faker->title(),
                    'details' => json_encode($faker->paragraph(5)),
                    'status' => JobOffer::STATUS_PENDING
                ]);
            }
        }
        catch (\Exception $exception)
        {
            Log::error("job Offer create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
