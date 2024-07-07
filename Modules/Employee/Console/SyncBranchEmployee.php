<?php

namespace Modules\Employee\Console;


use App\Models\RootModel;
use App\Services\ZKTService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchSetting;
use Modules\Employee\Entities\Employee;


class SyncBranchEmployee extends Command
{
    /**
     * this command should run in every 10 minutes
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inta:syncBranchEmp {branchId}';

    protected $service;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync branch employees';

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
        $branchId = $this->argument('branchId');

        try {

            //Company device ip
            $deviceIp = BranchSetting::where('attendance', BranchSetting::ATTENDANCE_IP)
                ->select('device_ip')
                ->whereNotNull('device_ip')
                ->where('enable_device', '!=', 0)
                ->where('branch_id', $branchId)
                ->first();

            if (! $deviceIp){
                Log::error('Device not found');
                Log::info("device missing from branch ". (Branch::find($branchId))->name);
                return false;
            }

            //Company device ip

            $employees = Employee::select('id', 'first_name', 'last_name', 'card_no', 'phone', 'employee_index')
                ->where('branch_id', $branchId)
                ->where('status', RootModel::STATUS_ACTIVE)
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

                //dd($this->service->getUser());
            }

        }catch(\Exception $exception){
            Log::error('branch employee sync error');
            Log::error(get_exception_message($exception));
            return false;
        }

        return true;
    }


}
