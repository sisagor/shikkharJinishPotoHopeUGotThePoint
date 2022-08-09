<?php

namespace App\Console;


use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
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
        $schedule->command('inta:get-att')->everyMinute()
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
        $schedule->command('inta:create-att')->everyMinute()
            ->onSuccess(function (Stringable $output)
            {
                Log::error("Create Attendance from Log Success!");
                Log::info($output);
            })
            ->onFailure(function (Stringable $output) {
                Log::error("Create Attendance from Log Error!");
                Log::info($output);
            });

        //Create employee tto the machine :
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
}
