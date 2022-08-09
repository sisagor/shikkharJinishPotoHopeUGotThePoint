<?php

namespace Modules\Timesheet\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;


class LeaveRequestRejected extends Notification
{
    use Dispatchable, Queueable;

    public $data;
    public $notifyTo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notifyTo, $data = null)
    {
        $this->data = $data;
        $this->notifyTo = $notifyTo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(get_sender_email(), get_sender_name())
            ->subject(trans('mail.leave_request_rejected.subject'))
            ->markdown('timesheet::mails.leaveReject', ['data' => $this->notifyTo, 'url' => route('timesheet.leave.approved')]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //'amount' => '10000',
        ];
    }


}
