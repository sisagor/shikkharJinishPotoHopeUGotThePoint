<?php

namespace Modules\Notification\Database\Seeders;

use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Notification\Entities\ScheduleEmailSms;

class ScheduleEmailDatabaseSeeder extends Seeder
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
            //Module Menu Seed

            DB::table('schedule_email_sms')->insert([
                'type' => ScheduleEmailSms::TYPE_EMAIL,
                'delivery_type' => 'daily',
                'delivery_time' => Carbon::now()->setTime(12, 0, 0)->format('H:i:s'),
                'details' => json_encode([
                    'emails' => 'admin@demo.com,company@demo.com',
                    'subject' => 'testing email',
                    'body' => 'Testing mail from inta'
                ]),
                'status' => RootModel::STATUS_ACTIVE,
            ]);

            //End Module Menu Seed

        } catch (\Exception $exception) {

            Log::error('Schedule Email Seed Failed!');
            Log::info(get_exception_message($exception));
        }

    }
}
