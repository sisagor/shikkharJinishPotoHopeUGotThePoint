<?php

namespace Modules\Notification\Jobs;

use Carbon\Carbon;
use Tzsk\Sms\Facades\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Notification\Entities\SmsLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Notification\Entities\EmailLog;


class SmsNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $numbers;

    public $body;

    protected $tries = 5;

    protected $timeout = 20;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public
    function __construct($numbers, $body)
    {
        $this->numbers = $numbers;
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
        $numbers = $this->numbers;
        // Send notifications to all active channels

        try {
            foreach($numbers as $number) {

                $send = Sms::send($this->body, function($sms) use ($number) {
                    $sms->to($number);
                });

                $status = 0;

                if($send){
                    $status = 1;
                }

                if(get_config_value('store_sms_log')) {

                    DB::table('sms_log')->insert([
                        'phone' => $number,
                        'sms' => $this->body,
                        'status' => $status,
                        'created_at' => Carbon::now()->format('Y-m-d')
                    ]);
                }
            }
        }
        catch(\Exception $exception){
            Log::error("Schedule sms sent error");
            Log::info(get_exception_message($exception));
        }

    }

}
