<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class ActivityNotification extends Notification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $broadcastQueue = 'sync';

    private $sentTo;
    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sentTo, $activity, $optional = null)
    {
        $this->sentTo = $sentTo;
        $this->data = $this->getFormattedData($activity, $optional);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = [];
        if (config('system_settings.system_realtime_notification')) {
            if (config('broadcasting.connections.pusher.key')) {

                $via = ['broadcast'];
            }
            else {
                throw new Exception('Pusher api key not found!');
            }
        }

        return array_merge(['database'], $via);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public
    function toDatabase($notifiable)
    {
        return $this->data;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return Channel
     */

    public
    function broadcastOn()
    {
        return new PrivateChannel('user-' . $this->sentTo);
        //return new Channel('notify');
    }


    public
    function broadcastAs()
    {
        return 'server.created';
    }

    /*Data*/
    public
    function broadcastWith()
    {
        return array_merge(['id' => $this->id], $this->data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public
    function toArray($notifiable)
    {
        return [
            //'amount' => '10000',
        ];
    }


    private
    function getFormattedData($activity, $optional = null)
    {
        return [
            'name' => Auth::user()->name,
            'activity' => $activity,
            'date' => Carbon::now()->diffForHumans(),
            'optional' => $optional,
        ];
    }


}
