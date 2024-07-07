<?php

namespace Modules\Employee\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Illuminate\Support\Facades\Artisan;


class RunSyncCommand extends Command
{
    /**
     * this command should run in every 10 minutes
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:sync-emp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync all employee';

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
            $companies = Company::select('id')
                ->active()
                ->get();

            foreach ($companies as $company) {
                Artisan::call('inta:syncComEmp ' . $company->id);
            }

            //Branch device ip
            $branches = Branch::select('id')
                ->active()
                ->get();

            foreach ($branches as $branch) {
                Artisan::call('inta:syncBranchEmp ' . $branch->id);
            }

        }catch (\Exception $exception){
            Log::error('Employee sync Error');
            Log::info(get_exception_message($exception));
            $this->info("Employee sync error. check log file for more details");
        }

        return true;
    }

}
