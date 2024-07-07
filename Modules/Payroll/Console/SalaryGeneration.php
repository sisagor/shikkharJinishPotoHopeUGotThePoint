<?php

namespace Modules\Payroll\Console;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\Payroll\Services\SalaryGenerationService;


class SalaryGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salaryGenerate {month} {employee}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate employee salary';

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

            return (new SalaryGenerationService(Carbon::parse($this->argument('month')), $this->argument('employee')))->generate();

        } catch (\Exception $exception) {

            dd($exception);
            Log::error("Salary generation error");

            Log::info(get_exception_message($exception));
        }

        $this->info("done without Error");
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['month', InputArgument::REQUIRED, 'salary month is required'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

}
