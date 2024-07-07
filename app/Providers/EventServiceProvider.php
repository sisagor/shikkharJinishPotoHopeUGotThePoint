<?php

namespace App\Providers;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            //SendActivityNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Queue::failing(function (JobFailed $event) {
            Log::channel('joblog')->error('Job Failed!', [
                'Queue Connection' => $event->connectionName,
                'Exception' => $event->exception,
            ]);
        });

        Queue::before(function (JobProcessing $event) {
            Log::channel('joblog')->info('............. Job Processing:: ' . $event->job->resolveName() . ' .................');
            Log::channel('joblog')->info(['payload' => $event->job->payload()]);
        });

        Queue::after(function (JobProcessed $event) {
            Log::channel('joblog')->info('......................... Job Processed Successfully .............................');
        });
        //


    }
}
