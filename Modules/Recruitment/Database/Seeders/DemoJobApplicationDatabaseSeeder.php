<?php

namespace Modules\Recruitment\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Job;
use Illuminate\Database\Eloquent\Model;
use Modules\Recruitment\Entities\JobApplication;


class DemoJobApplicationDatabaseSeeder extends Seeder
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

            //$jobs = Job::where('status', Job::STATUS_OPEN)->get();
            $jobs = DB::table('job_posting')->select('id')->where('status', Job::STATUS_OPEN)->get();

            foreach ($jobs as $key => $item){

                DB::table('job_applications')->insert([
                    'com_id' => 1,
                    'job_id' => $item->id,
                    'name' => $faker->name,
                    'phone' => $faker->phoneNumber(),
                    'email' => $faker->email(),
                    'expected_salary' => $faker->randomNumber(5),
                    'cover_later' => $faker->paragraph(5),
                    'status' => (
                        $key < 3 ? JobApplication::STATUS_APPROVED
                        : ( $key < 5 ? JobApplication::STATUS_INTERVIEW
                            : JobApplication::STATUS_JOB_OFFER
                        )
                    )
                ]);

            }



        } catch (\Exception $exception) {

            Log::error("job application create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
