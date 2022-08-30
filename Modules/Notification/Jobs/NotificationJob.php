<?php

namespace Modules\Notification\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Notification\Entities\EmailLog;


class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emails;

    public $subject;

    public $body;

    public $notifiable;

    protected $tries = 5;

    protected $timeout = 20;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public
    function __construct($notifiable, $emails, $subject, $body)
    {
        $this->notifiable = $notifiable;
        $this->emails = $emails;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public
    function handle()
    {
        // Send notifications to all active channels
        try {

            foreach($this->emails as $email) {
                $sent = Mail::to($email)->send(new $this->notifiable($email, $this->subject, $this->body));

                $status = 0;
                if($sent) {
                    $status = 1;
                }

                if(get_config_value('store_email_log')) {

                    DB::table('email_log')->insert([
                        'email' => $email,
                        'subject' => $this->subject,
                        'body' => json_encode($this->body),
                        'status' => $status,
                        'created_at' => Carbon::now()->format('Y-m-d')
                    ]);
                }
                //Mail::to($this->details['email'])->send($email);
            }
        }
        catch(\Exception $exception)
        {
            Log::error("Schedule email sent error!");
            Log::info(get_exception_message($exception));

        }
    }

}
