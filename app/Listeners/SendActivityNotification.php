<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\ActivityNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendActivityNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        //$admin = User::where('level', User::USER_ADMIN_ADMIN)->whereNull('com_id')->first();

        //Notification::send($admin, ActivityNotification::class);

    }
}
