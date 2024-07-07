<?php

namespace Modules\Employee\Console;


use App\Models\RootModel;
use App\Services\ZKTService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Modules\Company\Entities\CompanySetting;


class SyncCompanyEmployee extends Command
{
    /**
     * this command should run in every 10 minutes
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:syncComEmp {comId}';

    protected $service;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync company employees';

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
        $comId = $this->argument('comId');

        try {

            //Company device ip
            $deviceIp = CompanySetting::where('attendance', CompanySetting::ATTENDANCE_IP)
                ->select('device_ip')
                ->whereNotNull('device_ip')
                ->where('enable_device', '!=', 0)
                ->where('com_id', $comId)
                ->first();

            if (! $deviceIp){
                Log::error('Device not found');
                Log::info("device missing from company ". (Company::find($comId))->name);
                return false;
            }

            //Company device ip

             $employees = Employee::select('id', 'first_name', 'last_name', 'card_no', 'phone', 'employee_index')
                 ->where('com_id', $comId)
                 ->where('status', RootModel::STATUS_ACTIVE)
                 ->whereNull('branch_id')
                 ->whereNull('device_id')
                 ->get();

            $this->service = new ZKTService($deviceIp->device_ip);

            if ($this->service->connect()) {
                /// $this->service->clearUsers();

                DB::beginTransaction();

                foreach ($employees as $employee) {
                    //$id = $employee->employee_index;
                    $id = (int)substr($employee->employee_index, (strlen($employee->employee_index) - 4));
                    $pass = substr($employee->phone, -6);
                    $card = $employee->card_no ?: 0;
                    $deviceOldEmp = count($this->service->getUser());

                    $this->service->setUser($id, "$id", $employee->full_name, "$pass", 0,  $card);

                    if (count($this->service->getUser()) > $deviceOldEmp) {
                        $employee->update(['device_id' => $id]);
                    }
                }

                DB::commit();

            }

        }catch(\Exception $exception){
            Log::error('company employee sync error');
            Log::error(get_exception_message($exception));
            return false;
        }

        return true;

    }


}
