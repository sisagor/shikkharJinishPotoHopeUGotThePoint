<?php

namespace Modules\Branch\Repositories;

use App\Models\User;
use App\Services\ZKTService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Branch\Entities\Branch;
use App\Repositories\EloquentRepository;
use Modules\Branch\Entities\BranchSetting;


class BranchRepository extends EloquentRepository implements BranchRepositoryInterface
{
    public $model;

    public function __construct(Branch $branch)
    {
        $this->model = $branch;
    }


    /*Get all branches*/
    public function all()
    {
        return $this->model->commonScope()->with('user.role:id,name')->select(Branch::$fetch);
    }

    /*Get all branches*/
    public function trashOnly()
    {
        return $this->model->onlyTrashed()->commonScope()
            ->with(['user' => function($item){
                $item->withTrashed()
                ->select('id', 'branch_id', 'role_id')
                ->with('role:id,name');
            }])
            ->select(Branch::$fetch);
    }


    /*Store Branch*/
    public function store(Request $request): bool
    {
        try {

            DB::beginTransaction();

            $create = Branch::create([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
            ]);


            User::create([
                'com_id' => $request->get('com_id') ?? Auth::user()->com_id,
                'branch_id' => $create->id,
                'role_id' => $request->get('role_id'),
                'level' => User::USER_BRANCH_ADMIN,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'status' => $request->get('status'),
            ]);

            DB::table('branch_settings')->insert([
                'com_id' => com_id(),
                'branch_id' => $create->id,
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


    /*Update Branch*/
    public function update(Request $request, $model): bool
    {
        try {


            DB::beginTransaction();

            $update = $model->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
            ]);


            $model->user->update([
                'role_id' => $request->get('role_id'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'status' => $request->get('status'),
            ]);


            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Branch update Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*profile update*/
    public function updateProfile(Request $request, Branch $branch)
    {
        try {

            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $branch->updateImage($request->file('image'), 'profile');
            }

            $branch->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
            ]);

            $branch->user->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
            ]);

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error("Branch update Failed");
            Log::info(get_exception_message($e));
            return false;
        }

        return true;
    }


    /*Delete branch */
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


    /*Update branch settings */
    public function updateSettings(Request $request)
    {
        try {

            if ($request->get('enable_device')){

                $service = new ZKTService(get_device_ip());
                $service->connect();
            }

            $branch = BranchSetting::where('branch_id', Auth::user()->branch_id)->first();

            $branch->update([
                'attendance' => $request->get('attendance'),
                'device_ip' => $request->get('device_ip'),
                'enable_device' => $request->get('enable_device'),
                'allow_employee_login' => $request->get('allow_employee_login'),
                'allow_overtime' => $request->get('allow_overtime'),
            ]);

        } catch (Exception $e) {

            DB::rollBack();
            Log::error("Branch update Failed");
            Log::info(get_exception_message($e));
            return false;
        }

        return true;
    }


}
