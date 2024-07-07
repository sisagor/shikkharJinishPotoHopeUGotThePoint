<?php

namespace Modules\Report\Console;

use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Console\Command;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;



class DailyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:create-att';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate attendance';

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
        //
    }

}
