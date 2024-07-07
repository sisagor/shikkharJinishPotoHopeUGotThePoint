<?php

namespace Modules\Notification\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;


class SendEmailNotification extends Mailable
{
    use Dispatchable, Queueable;

    public $subject;
    public $body;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $body = null)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return //MailMessage
     */

    public function build()
    {
        return $this->from(get_sender_email(), get_sender_name())
            ->subject($this->subject)
            ->markdown('notification::mails.sendMail', ['body' =>  $this->body]);
    }



}
