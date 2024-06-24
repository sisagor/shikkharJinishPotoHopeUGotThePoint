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
        return $this->model->with(['user' => function($user){
            $user->with('role:id,name')
                ->select('com_id','role_id','status');
        }]);
    }

    public function trashOnly()
    {
        //Cache::forget('companies_' . Auth::id());
        return $this->model->onlyTrashed()->with(['user' => function($user){
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

        } catch (\Exception $e) {
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

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error("User create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }

    /** update company settings*/
    public function updateSettings(Request $request)
    {
        try
        {
            $request = $request->all();

            unset($request['_token']);
            unset($request['submit']);

            foreach ($request as $key => $value) {
                $settings = CompanySetting::where('key', $key)->where('com_id', com_id())->first();

                if ($settings){
                    $settings->update(['value' => $value]);
                }
                else
                {
                    CompanySetting::create([
                        'com_id' => com_id(),
                        'key' => $key,
                        'value' => $value,
                    ]);
                }



            }

            return true;
        }
        catch (\Exception $exception)
        {
            Log::error("system setting update failed!");
            Log::info(get_exception_message($exception));

            return false;
        }
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


}
