<?php

namespace Modules\User\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\User\Entities\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;


class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public $model;

    public function __construct(Profile $profile)
    {
        $this->model = $profile;
    }

    public function all()
    {
        return $this->model->mine()
            ->with(['user' => function($item){
                $item->with('role:id,name')
                    ->select('id','role_id','profile_id','level','status');
            }])
            ->whereHas('user', function ($query){
                $query->where('level', '!=', User::USER_SUPER_ADMIN)->where('level', '!=', User::USER_ADMIN_ADMIN);
            });
    }

    public function trashOnly()
    {
        // Cache::forget('profiles_'.Auth::id());
        return $this->model->onlyTrashed()->mine()
            ->with(['user' => function($item){
                $item->withTrashed()
                ->with('role:id,name')
                ->select('id','role_id','profile_id','level','status');
            }])
            ->whereHas('user', function ($query){
                $query->where('level', '!=', User::USER_SUPER_ADMIN)->where('level', '!=', User::USER_ADMIN_ADMIN);
            });
    }

    /*Store user*/
    public function store(Request $request): bool
    {
        //check iRole level and define user level and company or branch.
        try {
            DB::beginTransaction();

            $profile = $this->model->create([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'dob' => $request->get('dob'),
                'gender' => $request->get('gender'),
                'address' => $request->get('address'),
                'occupation' => $request->get('occupation'),
                'about' => $request->get('about'),
                'facebook' => $request->get('facebook'),
                'twitter' => $request->get('twitter'),
                'instagram' => $request->get('instagram'),
                'linkedin' => $request->get('linkedin'),
            ]);

            $level = ($request->get('manager') == User::USER_MANAGER ? User::USER_MANAGER : User::USER_ADMIN);

            User::create([
                'com_id' => com_id(),
                'profile_id' => $profile->id,
                'role_id' => $request->get('role_id'),
                'level' => $level,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'status' => $request->get('status'),
                'password' => bcrypt($request->get('password')),
            ]);

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();
            Log::error("User create Failed");
            Log::info(get_exception_message($exception));

            return false;
        }

        return true;
    }

    /*Update user*/
    public function update(Request $request, $model): bool
    {

        //check iRole level and define user level and company or branch.
        try {
            DB::beginTransaction();

             $model->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'dob' => $request->get('dob'),
                'gender' => $request->get('gender'),
                'address' => $request->get('address'),
                'email' => $request->get('email'),
                'occupation' => $request->get('occupation'),
                'about' => $request->get('about'),
                'facebook' => $request->get('facebook'),
                'twitter' => $request->get('twitter'),
                'instagram' => $request->get('instagram'),
                'linkedin' => $request->get('linkedin'),
            ]);


            $model->user->update([
                'role_id' => $request->get('role_id'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'status' => $request->get('status'),
            ]);

            //Cache::forget('users_'.Auth::id())
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            //dd($exception);
            Log::error("User create failed");
            Log::info(get_exception_message($exception));

            return false;
        }

        return true;
    }

    /*Update user Profile*/
    public function updateUserProfile(Request $request, Profile $profile): bool
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $profile->updateImage($request->file('image'), 'profile');
            }

            $profile->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'dob' => $request->get('dob'),
                'gender' => $request->get('gender'),
                'address' => $request->get('address'),
            ]);

            $profile->user->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
            ]);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error("User create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*user password Update*/
    public function userPasswordUpdate(Request $request, User $user): bool
    {
        if (password_verify($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->get('password'));
            $user->save();

            return true;
        }

        return false;
    }

}
