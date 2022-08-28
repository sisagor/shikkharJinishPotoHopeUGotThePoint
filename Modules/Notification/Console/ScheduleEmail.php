<?php

namespace Modules\Notification\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Notification\Jobs\NotificationJob;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\Notification\Entities\ScheduleEmailSms;
use Modules\Notification\Notifications\SendEmailNotification;


class ScheduleEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'inta:scheduleEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send schedule sms and email regarding to the given schedule.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $details = ScheduleEmailSms::where('type', ScheduleEmailSms::TYPE_EMAIL)->select('details')->first();

            if ($details) {
                $json = json_decode($details->details);
                $emails = explode(',', $json->emails);
                $subject = ($json->subject ?? null);
                $body = ($json->body ?? null);

                dispatch(new NotificationJob(SendEmailNotification::class, $emails, $subject, $body))->delay(Carbon::now()->addMinute());
            }
        }
        catch (\Exception $exception)
        {
            Log::error("Email sending error!");
            Log::info(get_exception_message($exception));
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
           // ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
