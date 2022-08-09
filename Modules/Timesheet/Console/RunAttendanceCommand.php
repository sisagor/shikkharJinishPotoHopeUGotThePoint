<?php

namespace Modules\Timesheet\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Branch\Entities\BranchSetting;
use Modules\Company\Entities\CompanySetting;


class RunAttendanceCommand extends Command
{
    /**
     * this command should run in every 10 minutes
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:get-att';

    protected $service;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will run attendance  Command';

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
            //Company device ip
            $companies = CompanySetting::where('attendance', CompanySetting::ATTENDANCE_IP)
                ->select('device_ip', 'com_id')
                ->whereNotNull('device_ip')
                ->where('enable_device', 1)
                ->get();

            foreach ($companies as $company) {
                Session::put('com_id', $company->com_id);
                Artisan::call('inta:getAtt ' . $company->device_ip);
                Session::forget('com_id');
            }

            //Branch device ip
            $branches = BranchSetting::where('attendance', BranchSetting::ATTENDANCE_IP)
                ->select('device_ip', 'branch_id')
                ->whereNotNull('device_ip')
                ->where('enable_device', 1)
                ->get();

            //Log::info($branches);

            foreach ($branches as $branch) {
                Session::put('branch_id', $branch->branch_id);
                Artisan::call('inta:getAtt ' . $branch->device_ip);
                Session::forget('branch_id');
            }

        }catch (\Exception $exception){
            Log::error('Attendance log create failed');
            Log::info(get_exception_message($exception));

            //$this->info("Attendance log create failed. check log file for more details");
        }

        //$this->info("Attendance log created successfully.");

    }

}
