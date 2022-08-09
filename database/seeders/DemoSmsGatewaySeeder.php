<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\DB;

class DemoSmsGatewaySeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            $data = config('sms.drivers.twilio');

            DB::table('sms_gateway')->insert([
                'driver' => 'twilio',
                'details' => json_encode($data),
                'status' => \App\Models\RootModel::STATUS_ACTIVE,
                'created_at' => Carbon::now(),
            ]);

        }catch (Exception $exception){
            \Log::error('sms gateway seed error');
            \Log::info(get_exception_message($exception));
        }

    }
}
