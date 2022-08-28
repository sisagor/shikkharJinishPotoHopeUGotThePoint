<?php

namespace Modules\Notification\Database\Seeders;

use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Notification\Entities\ScheduleEmailSms;

class ScheduleSmsDatabaseSeeder extends Seeder
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

            DB::table('schedule_email_sms')->insert([
                'type' => ScheduleEmailSms::TYPE_SMS,
                'delivery_type' => 'daily',
                'delivery_time' => Carbon::now()->setTime(12, 0, 0)->format('H:i:s'),
                'details' => json_encode(['numbers' => '+88018526319556, +8801766296281', 'body' => 'Testing mail from inta']),
                'status' => RootModel::STATUS_ACTIVE,
            ]);

        } catch (\Exception $exception) {

            Log::error('Schedule SMS Seed Failed!');
            Log::info(get_exception_message($exception));
            DB::rollBack();
        }

        DB::commit();
    }
}
