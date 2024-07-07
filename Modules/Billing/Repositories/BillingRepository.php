<?php

namespace Modules\Billing\Repositories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Billing\Entities\Billing;
use App\Repositories\EloquentRepository;


class BillingRepository extends EloquentRepository implements BillingRepositoryInterface
{
    public $model;

    public function __construct(Billing $billing)
    {
        $this->model = $billing;
    }

    //Pendings bill
    public function pendingBills()
    {
        //Cache::forget('companies_' . Auth::id());
        $data = $this->model->select(Billing::$fetch)
            ->mine()
            ->with('manager:id,name')
            ->with('project:id,name')
            ->with('employee:id,name');

        if (Auth::user()->manager == User::USER_MANAGER)
        {
            $data->where('manager_id', Auth::id())->whereNull('approve_one');
        }
        else if (Auth::user()->employee_id)
        {
            $data->where('employee_id', Auth::user()->employee_id)->where('status', Billing::BILLING_STATUS_PENDING);
        }
        else
        {
            $data->whereNotNull('approve_one')->whereNull('approve_two');
        }
        return $data;
    }

    //Approved bills
    public function approvedBills()
    {
        //Cache::forget('companies_' . Auth::id());
        $data = $this->model->select(Billing::$fetch)
            ->mine()
            ->with('manager:id,name')
            ->with('project:id,name')
            ->with('employee:id,name');

        if (Auth::user()->manager == User::USER_MANAGER)
        {
            $data->where('manager_id', Auth::id())->whereNotNull('approve_one');
        }
        else if (Auth::user()->employee_id)
        {
            $data->where('employee_id', Auth::user()->employee_id)->where(function ($query){
                $query->where('status', Billing::BILLING_STATUS_APPROVE_MANAGER)
                ->orWhere('status', Billing::BILLING_STATUS_APPROVE_ADMIN);
            });
        }
        else
        {
            $data->whereNotNull('approve_one')->whereNotNull('approve_two');
        }
        return $data;
    }


    /*Store Company*/
    public function store(Request $request): bool
    {
        try {

            if ($this->model->where('created_at', Carbon::today())->where('created_by', Auth::id())->count()){
                Session::put('error', 'You can\'t create anymore bill today! try again tomorrow.');
                return false;
            }

            $store = $this->model->create([
                'employee_id' => (is_employee() ? Auth::user()->employee_id : $request->get('employee_id')),
                'manager_id' => $request->get('manager_id'),
                'project_id' => $request->get('project_id'),
                'office_id' => $request->get('office_id'),
                'site_id' => $request->get('site_id'),
                'title' => $request->get('title'),
                'mobile_bill' => $request->get('mobile_bill'),
                'other_bill' => $request->get('other_bill'),
                'other_bill_history' => $request->get('other_bill_history'),
                'allowance' => $request->get('allowance'),
                'allowance_history' => $request->get('allowance_history'),
                'total' => $request->get('total'),
                'status' => 0,
                'created_by' => Auth::id(),
            ]);

            if ($request->hasFile('attachment')){
                $store->saveDocument($request->file('attachment'), 'invoice'.$store->id);
            }

        } catch (\Exception $e) {

            Log::error("Bill create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*Update Company*/
    public function update(Request $request, $model): bool
    {
        try {

            if (is_company_admin() || is_admin()){
                $approve = ['approve_two' => Auth::id()];
            }
            else
            {
                $approve = ['approve_one' => Auth::id()];
            }

            $model->update(
                array_merge([
                    'employee_id' => (is_employee() ? Auth::user()->employee_id : $request->get('employee_id')),
                    'manager_id' => $request->get('manager_id'),
                    'project_id' => $request->get('project_id'),
                    'office_id' => $request->get('office_id'),
                    'site_id' => $request->get('site_id'),
                    'title' => $request->get('title'),
                    'mobile_bill' => $request->get('mobile_bill'),
                    'other_bill' => $request->get('other_bill'),
                    'other_bill_history' => $request->get('other_bill_history'),
                    'allowance' => $request->get('allowance'),
                    'allowance_history' => $request->get('allowance_history'),
                    'total' => $request->get('total'),
                    'status' => $request->get('status'),
                    'updated_at' => Carbon::now(),
                ],$approve)
            );

        } catch (\Exception $e) {

            Log::error("Company update Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }




    public function destroy($model): bool
    {
        try {
            DB::beginTransaction();

            $model->user->forceDelete();
            $model->forceDelete();

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Delete Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }

    //Reports
    public function report(Request $request)
    {
        //Cache::forget('companies_' . Auth::id());
        $data = $this->model->select(Billing::$fetch)
            ->mine()
            ->with('manager:id,name')
            ->with('project:id,name')
            ->with(['employee'=> function($item)
            {
                $item->select('id', 'name')->withSum('bill', 'loan_amount');
            }])
            ->whereNotNull('approve_one')
            ->whereNotNull('approve_two');

        if ($request->filled('com_id')){
            $data->where('com_id', $request->get('com_id'));
        }
        if ($request->filled('employee_id')){
            $data->where('employee_id', $request->get('employee_id'));
        }

        return $data;


    }

}
