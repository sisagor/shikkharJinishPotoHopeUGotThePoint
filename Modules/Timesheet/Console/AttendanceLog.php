<?php

namespace Modules\Timesheet\Console;


use App\Services\ZKTService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Employee\Entities\Employee;


class AttendanceLog extends Command
{
    /**
     * this command should run in every 10 minutes
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:getAtt {device_ip}';

    /**
     * Service object
     */
    protected $service;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate attendance log';

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
        $this->info("Get attendance from device is processing...");
        $deviceIp = $this->argument('device_ip');
        //var_dump($deviceIp);
        $this->service = new ZKTService($deviceIp);

        if ($this->service->connect()){
            /// $this->service->clearUsers();
            //$data = $this->service->setUser(5,"5", 'sagor', '123456', 0, "0000765423");
            //($this->service->clearUsers());
            //dd($this->service->getAttendance());
            $this->getAttendanceFromMachine();
            return true;
        }
        else
        {
            return false;
        }
        ///return $this->getAttendanceFromMachine();

    }

    //Creating attendance Log
    protected function getAttendanceFromMachine(){

        try {

            $this->service->enableDevice();
            $attendances = $this->service->getAttendance();
            //$this->info($this->service->getUser());

            DB::beginTransaction();

            foreach ($attendances as $att){

                $emp = Employee::select('id', 'com_id', 'branch_id');
                (session('com_id') ?  $emp->where('com_id', session('com_id')) : $emp);
                (session('branch_id') ?  $emp->where('branch_id', session('branch_id')) : $emp);
                $emp = $emp->where('device_id', $att['id'])->first();

                if (! $emp) {
                    continue;
                }

                //Check if alreaddy
                $check = DB::table('attendance_log')
                    ->where('employee_id', $emp->id)
                    ->where('punch_time', $att['timestamp']);

                ($emp->com_id ?  $emp->where('com_id', $emp->com_id)->whereNotNull('com_id') : $emp);
                ($emp->branch_id ?  $emp->where('branch_id', $emp->branch_id)->whereNotNull('branch_id') : $emp);

                $check = $check->count();


                if (! $check) {

                    DB::table('attendance_log')->insert([
                        'com_id' => $emp->com_id,
                        'branch_id' => $emp->branch_id,
                        'device_ip' => $this->service->deviceIp(),
                        'employee_id' => $emp->id,
                        'punch_time' => $att['timestamp'],
                        'state' => $att['state'],
                        'type' => $att['type'],
                        'status' => 0,
                    ]);
                }

            }

            DB::commit();

            $this->info("Attendance log created successfully!");
            //$this->service->clearAttendance();

        }
        catch (\Exception $exception) {
            Log::error("Attendance Taking from machine Failed!");
            Log::info(get_exception_message($exception));
        }

    }

}
