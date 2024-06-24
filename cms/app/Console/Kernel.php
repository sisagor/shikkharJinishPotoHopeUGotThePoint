<?php

namespace App\Console;


use Carbon\Carbon;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Modules\Notification\Entities\ScheduleEmailSms;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        //Get attendance from machine and create attendance Log:
        $schedule->command('inta:get-att')->everyThreeMinutes()
            ->onSuccess(function (Stringable $output)
            {
                Log::error("Get Attendance from device Success!");
                Log::info($output);
            })
            ->onFailure(function (Stringable $output) {
                Log::error("Get Attendance from device Error!");
                Log::info($output);
            });

        //Create Attendance from attendance Log table:
        $schedule->command('inta:create-att')->everyFiveMinutes()
            ->onSuccess(function (Stringable $output)
            {
                Log::error("Create Attendance from Log Success!");
                Log::info($output);
            })
            ->onFailure(function (Stringable $output) {
                Log::error("Create Attendance from Log Error!");
                Log::info($output);
            });


        ##run schedule job;
        $schedule->command('inta:schedule-job')->everyThirtyMinutes()
            ->onSuccess(function (Stringable $output)
            {
                Log::error("Schedule job running Success!");
                Log::info($output);
            })
            ->onFailure(function (Stringable $output) {
                Log::error("Schedule job running error");
                Log::info($output);
            });

        //Create employee to the machine :
        /* $schedule->command('inta:sync-emp')->everyTenMinutes()
             ->onSuccess(function (Stringable $output)
                 {
                     Log::error("Employee Sync with device Success!");
                     Log::info($output);
                 })
                 ->onFailure(function (Stringable $output) {
                     Log::error("Employee Sync with device Error!");
                     Log::info($output);
                 });*/



        //Notification : Schedule Email;
         $emailDetails = $this->getSchedule(ScheduleEmailSms::TYPE_EMAIL);

        if ($emailDetails) {
              $run = $schedule->command('inta:scheduleEmail');
              $this->getEvent($emailDetails->delivery_type, $run)
                  ->at(Carbon::parse($emailDetails->delivery_time)->format('H:i'))
                  ->timezone('asia/dhaka')
                 ->onSuccess(function (Stringable $output) {
                     Log::info("Schedule emails sent success!");
                     Log::info($output);
                 })
                 ->onFailure(function (Stringable $output) {
                     Log::error("Schedule emails sent failed!");
                     Log::info($output);
                 });
        }
        //end schedule email

        //Notification: Schedule sms;
         $smsDetails = $this->getSchedule(ScheduleEmailSms::TYPE_SMS);

        if ($smsDetails) {
              $run = $schedule->command('inta:scheduleSms')->everyMinute()
              //$this->getEvent($smsDetails->delivery_type, $run)
                  //->at(Carbon::parse($smsDetails->delivery_time)->format('H:i'))
                  ->timezone('asia/dhaka')
                  ->onSuccess(function (Stringable $output) {
                     Log::info("Schedule sms sent success!");
                     Log::info($output);
                  })
                  ->onFailure(function (Stringable $output) {
                     Log::error("Schedule sms sent failed!");
                     Log::info($output);
                  });
        }
        //end schedule sms

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }


    //return delivery time and event type:
    protected function getSchedule($type){
        return ScheduleEmailSms::select('delivery_time', 'delivery_type')->where('type', $type)->first();
    }


    //return schedule event when to execute:
    protected function getEvent($type, $serial){
        switch ($type) {
            case 'daily':
                return $serial->daily();
                break;

            case 'weekly':
                return $serial->weekly();
                break;

            case 'monthly':
                return $serial->monthly();
                break;
        }
    }

}
