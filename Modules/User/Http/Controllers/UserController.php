<?php

namespace Modules\User\Http\Controllers;


use App\Models\User;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Profile;
use App\Http\Controllers\Controller;
use App\Models\EmailSubscription;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\Http\Requests\UserCreateRequest;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Http\Requests\ResetPasswordRequest;
use Modules\User\Repositories\UserRepositoryInterface;
use Modules\User\Http\Requests\UserProfileUpdateRequest;
use Modules\User\Http\Requests\UserPasswordUpdateRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        //dd($this->user->users()->get());
        if(! $request->ajax()){
            return view('user::user.index');
        }

        if ($request->get('type') == "active"){

            return DataTables::of($this->user->all())
                ->addIndexColumn()
                ->editColumn('role', function ($row) {
                    return (! empty($row->user) && ! empty($row->user->role) ? $row->user->role->name : null);
                })
                ->editColumn('level', function ($row) {
                    return (! empty($row->user) ? $row->user->level : null);
                })
                ->editColumn('status', function ($row) {
                    return (! empty($row->user) ? get_status($row->user->status) : null );
                })
                ->addColumn('action', function ($row) {
                    return edit_button('userManagements.user.edit', $row) . trash_button('userManagements.user.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }


        if ($request->get('type') == "trash"){

            return DataTables::of($this->user->trashOnly())
                ->addIndexColumn()
                ->editColumn('role', function ($row) {
                    return (! empty($row->user) && ! empty($row->user->role) ? $row->user->role->name : null);
                })
                ->editColumn('level', function ($row) {
                    return (! empty($row->user) ? get_role_level($row->user->level) : null);
                })
                ->editColumn('status', function ($row) {
                    return (! empty($row->user) ?  get_status($row->user->status) : null);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('userManagements.user.restore', $row) . delete_button('userManagements.user.delete', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    /**add new user*/
    public function create()
    {
        set_action('userManagements.user.store');
        set_action_title('new_user');
        $profile = [];

        return view("user::user.newEdit", compact('profile'));
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        $user = $this->user->store($request);

        if ($user) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.user')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.user')]));
        }
        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.user')]));
    }


    /**
     * edit user profile and user;
     */
    public function edit(Profile $profile)
    {
        // $profile = Profile::find($id);
        set_action('userManagements.user.update', $profile);
        set_action_title('edit_user');

        return view('user::user.newEdit', compact('profile'));

    }


    /**
     * @param UserUpdateRequest $request
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, Profile $profile): RedirectResponse
    {
        $user = $this->user->update($request, $profile);

        if ($user) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.user')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.user')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.user')]));
    }

    /*user profile */
    public function profile(Profile $profile)
    {
        set_action('userManagements.user.profile.update', $profile);
        set_action_title('profile');

        return view('user::user.profile', compact('profile'));
    }


    /**
     * @param UserProfileUpdateRequest $request
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function profileUpdate(UserProfileUpdateRequest $request, Profile $profile): RedirectResponse
    {
        $user = $this->user->updateUserProfile($request, $profile);

        if ($user) {
            sendActivityNotification(trans('msg.noty.profile_updated', ['model' => trans('model.user')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.user')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.user')]));

    }


    public function changePassword(User $user)
    {
        set_action('userManagements.user.pass.update', $user);
        set_action_title('update_password');

        return view('user::user.passChange');
    }


    /**
     * @param UserPasswordUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updatePassword(UserPasswordUpdateRequest $request, User $user): RedirectResponse
    {
        $passwordUpdate = $this->user->userPasswordUpdate($request, $user);

        if ($passwordUpdate) {
            return redirect()->back()->with('success', trans('msg.password_update_success'));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.user')]));
    }

    /**
     * soft Delete data from database
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function trash($profile): RedirectResponse
    {
        if (check_module_status('Billing') && check_bill_emp_user_exist("manager_id", $profile))
        {
            return redirect()->back()->with('warning', trans('msg.dependency_detected_on_bill', ['model' => trans('model.user')]));
        }

        if ($this->user->trash($profile)) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.user')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.user')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.user')]));
    }

    /**
     *restore data from database
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function restore($profile): RedirectResponse
    {
        $user = User::onlyTrashed()->where('profile_id', $profile)->restore();
        $profile = $this->user->restore($profile);

        if ($user && $profile) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.user')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.user')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.user')]));
    }

    /**
     * Delete data from database
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function destroy($profile): RedirectResponse
    {

        if ($this->user->destroy($profile)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.user')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.user')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.user')]));
    }


    /*search and get user data*/
   public function getUser(Request $request)
    {
        $search = ($request->get('search'));

        if (strlen($search) > 3){

            $users = User::where('level', '!=', User::USER_SUPER_ADMIN)
                ->where('level', '!=', User::USER_ADMIN_ADMIN);
                $users = (com_id() ? $users->where('level', '!=', User::USER_COMPANY_ADMIN) : $users);
                $users = $users->where('status', RootModel::STATUS_ACTIVE)
                ->where('email', 'LIKE', $search.'%')
                ->select('id', DB::raw('CONCAT(name, " | ", email) as text'))
                ->get();

            if ($users) {
                return response()->json($users);
            }

            return response()->json(['id' => '0', 'text' => trans('msg.not_found', ['model' => trans('model.user')])]);
        }
    }



    /*Reset password*/
    public function resetPassword(Request $request)
    {

        set_action('userManagements.user.resetPass');
        set_action_title('reset_password');
        return view('user::user.resetPass');
    }


    /**
     * @param UserPasswordUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updateResetPassword(ResetPasswordRequest $request): RedirectResponse
    {

        $update = User::where('id', $request->get('user_id'))->update([
            'password' => bcrypt($request->get('password'))
        ]);

        if ($update) {
            return redirect()->back()->with('success', trans('msg.password_update_success'));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.user')]));
    }

    public function subscribe(Request $request)
    {
        if(! $request->ajax()){
            return view('user::user.subscribe');
        }

        $data = EmailSubscription::get();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return delete_button('userManagements.subscribe.delete', $row);
                })
                ->make(true);
        }
    }

    public function subscribeDelete($id)
    {
        $delete = EmailSubscription::where('id', $id)->delete();

        if($delete){
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('app.subscriber')]));
        }
       
        return redirect()->back()->with('success', trans('msg.delete_failed', ['model' => trans('app.subscriber')]));
    }


}
