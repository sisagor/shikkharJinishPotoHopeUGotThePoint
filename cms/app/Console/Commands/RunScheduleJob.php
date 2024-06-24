<?php

namespace App\Console\Commands;

use App\Models\ScheduleJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RunScheduleJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:schedule-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cached images from storage';

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
        $items = ScheduleJob::query()->cursor();

        try {
            DB::beginTransaction();

            foreach ($items as $item) {
                if ((Carbon::createFromDate($item->action_date)->diffInDays(Carbon::now())) == 0) {
                    if ($item->action == ScheduleJob::ACTION_CREATE) {
                        $this->create($item->class, $item->data);
                    }

                    if ($item->action == ScheduleJob::ACTION_UPDATE) {
                        $this->update($item->class, $item->data, $item->class_id);
                    }

                   $item->delete();
                }
            }

            DB::commit();

        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            Log::error('Schedule job run error');
            Log::info(get_exception_message($exception));
        }
    }


    //Craete something via schedule
    protected function create($class, $data)
    {
        return (new $class())->create(json_decode($data, true));
    }

    //Update something via schedule
    protected function update($class, $data, $id)
    {
        return (new $class())->where('id', $id)->update(json_decode($data, true));
    }

    //Delete something via schedule
    protected function delete($class, $id)
    {
        return (new $class())->where('id', $id)->delete();
    }
}

