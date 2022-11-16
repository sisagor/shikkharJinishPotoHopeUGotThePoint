<?php

namespace Modules\Company\Repositories;

use App\Models\User;
use App\Services\ZKTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Company\Entities\Company;
use App\Repositories\EloquentRepository;
use Modules\Company\Entities\CompanySetting;


class CompanyRepository extends EloquentRepository implements CompanyRepositoryInterface
{
    public $model;

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function all()
    {
        //Cache::forget('companies_' . Auth::id());
        return $this->model->withCount('branches')
            ->with(['user' => function($user){
                $user->with('role:id,name')
                    ->select('com_id','role_id','status');
            }]);
    }

    public function trashOnly()
    {
        //Cache::forget('companies_' . Auth::id());
        return $this->model->onlyTrashed()->withCount('branches')
            ->with(['user' => function($user){
                $user->with('role:id,name')
                    ->withTrashed()
                    ->select('com_id','role_id','status');
            }]);
    }

    /*Store Company*/
    public function store(Request $request): bool
    {
        //check iRole level and define user level and company or branch.
        $level = $request->get('user_level');

        try {

            DB::beginTransaction();

            $create = $this->model->create([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
                'status' => $request->get('status'),
            ]);

            User::create([
                'com_id' => $create->id,
                'role_id' => $request->get('role_id'),
                'level' => User::USER_COMPANY_ADMIN,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'status' => $request->get('status'),
            ]);

            CompanySetting::create([
                'com_id' => $create->id,
                'attendance' => "manual",
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Company create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*Update Company*/
    public function update(Request $request, $model): bool
    {

        try {
            DB::beginTransaction();

            $model->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
            ]);

            $model->user->email = $request->get('email');
            $model->user->role_id = $request->get('role_id');
            $model->user->status = $request->get('status');
            $model->user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Company update Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }

    /*Update user Profile*/
    public function updateProfile(Request $request, Company $company): bool
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $company->updateImage($request->file('image'), 'profile');
            }

            $company->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
                'details' => $request->get('details'),
            ]);

            $company->user->name = $request->get('name');
            $company->user->email = $request->get('email');
            $company->user->save();

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error("User create Failed");
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


    public function updateSettings(Request $request): bool
    {
        $setting = CompanySetting::where('com_id', com_id())->first();

        try {

            if ($request->has('general_settings')) {

                if ($request->get('enable_device')) {
                    $service = new ZKTService(get_device_ip());
                    $service->connect();
                }

                $setting->update([
                    'yearly_leave' => $request->get('yearly_leave'),
                    'employee_id_prefix' => $request->get('employee_id_prefix'),
                    'employee_id_length' => $request->get('employee_id_length'),
                    'attendance' => $request->get('attendance'),
                    'has_provision_period' => $request->get('has_provision_period') ?? 0,
                    'allow_overtime' => $request->get('allow_overtime') ?? 0,
                    'has_attendance_deduction_policy' => $request->get('has_attendance_deduction_policy') ?? 0,
                    'has_allowances' => $request->get('has_allowances') ?? 0,
                    'allow_employee_login' => $request->get('allow_employee_login') ?? 0,
                    'allow_holiday_work_as_overtime' => $request->get('allow_holiday_work_as_overtime') ?? 0,
                    'device_ip' => $request->get('device_ip'),
                    'enable_device' => $request->get('enable_device'),
                    'default_password' => $request->get('default_password'),
                ]);
            }

            if ($request->has('wallet_settings')) {

                $setting->update([
                    'has_provident_fund' => $request->get('has_provident_fund') ?? 0,
                    'employee_pf' => $request->get('employee_pf') ?? 0,
                    'company_pf' => $request->get('company_pf') ?? 0,

                    'has_welfare_fund' => $request->get('has_welfare_fund') ?? 0,
                    'welfare_fund_amount' => $request->get('welfare_fund_amount') ?? 0,

                    'has_gratuity' => $request->get('has_gratuity') ?? 0,
                    'gratuity_apply_after' => $request->get('gratuity_apply_after') ?? 0,
                ]);
            }

        } catch (\Exception $exception) {
           // dd($exception);
            Log::error('settings update Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


}
