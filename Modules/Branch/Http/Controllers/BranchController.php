<?php

namespace Modules\Branch\Http\Controllers;

use App\Models\User;
use App\Services\ZKTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Branch\Entities\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Branch\Http\Requests\BranchUpdateRequest;
use Modules\Branch\Http\Requests\BranchCreateRequest;
use Modules\Branch\Repositories\BranchRepositoryInterface;
use Modules\Branch\Http\Requests\BranchProfileUpdateRequest;
use Modules\Branch\Http\Requests\BranchSettingsUpdateRequest;


class BranchController extends Controller
{

    protected $repository;

    public function __construct(BranchRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('branch::index');
        }

        if ($request->get('type') == "active"){

            $data = $this->repository->all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('role', function ($row) {
                    return $row->user->role->name;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button($row, 'modal') . trash_button($row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            $trash = $this->repository->trashOnly();

            return DataTables::of($trash)
                ->addIndexColumn()
                ->editColumn('role', function ($row) {
                    return $row->user->role->name;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button($row) . delete_button($row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function create(): Renderable
    {
        set_action('branch.branch.store');
        set_action_title('new_branch');
        $branch = [];

        return view('branch::newEdit', compact('branch'));
    }


    /**
     * @param BranchCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BranchCreateRequest $request): RedirectResponse
    {
        $branch = $this->repository->store($request);

        if ($branch) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.branch')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.branch')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.branch')]));
    }


    /** Edit  branch*/
    public function edit(Branch $branch): Renderable
    {
        set_action('branch.branch.update', $branch);
        set_action_title('edit_branch');

        return view('branch::newEdit', compact('branch'));

    }

    /**
     * @param BranchCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BranchUpdateRequest $request, Branch $branch): RedirectResponse
    {
        $update = $this->repository->update($request, $branch);

        if ($update) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.branch')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.branch')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.branch')]));
    }


    /**update branch*/
    public function profile(Branch $branch): Renderable
    {
        set_action('branch.branch.profile.update', $branch);
        return view('branch::profile', compact('branch'));
    }


    /**
     * @param BranchProfileUpdateRequest $request
     * @param Branch $branch
     * @return RedirectResponse
     */
    public function profileUpdate(BranchProfileUpdateRequest $request, Branch $branch): RedirectResponse
    {
        $profile = $this->repository->updateProfile($request, $branch);

        if ($profile) {

            sendActivityNotification(trans('msg.noty.profile_updated', ['model' => trans('model.branch')]));

            return redirect()->back()->with('success', trans('msg.profile_update_success', ['model' => trans('model.branch')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.branch')]));
    }


    /**
     * @param Branch $branch
     * @return RedirectResponse
     */
    public function destroy($branch): RedirectResponse
    {
        if (Branch::onlyTrashed()->find($branch)->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.branch')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.branch')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.branch')]));
    }

    /**
     * @param Branch $branch
     * @return RedirectResponse
     */
    public function trash(Branch $branch): RedirectResponse
    {
        if ($branch->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.branch')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.branch')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.branch')]));
    }

    /**
     * @param Branch $branch
     * @return RedirectResponse
     */
    public function restore($branch): RedirectResponse
    {
        $user = User::onlyTrashed()->where('branch_id', $branch)->restore();
        $branch = $this->repository->restore($branch);

        if ($user && $branch) {

            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.branch')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.branch')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.branch')]));
    }



    /*branch settings */
    public function settings()
    {
        return view('branch::settings');
    }

    /*branch settings */
    public function settingsUpdate(BranchSettingsUpdateRequest $request)
    {
        $update = $this->repository->updateSettings($request);

        if ($update) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.branch_setting')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.branch_setting')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.branch_setting')]));
    }



    public function deviceTest()
    {
        $service = new ZKTService(get_device_ip());

        try {

            if ($service->connect()) {
                return redirect()->back()->with('success', 'Device connected');
            }

        }catch (FatalError $exception){

            //dd($exception);
            Log::error('Device Connect Error');
            Log::error(get_exception_message($exception));

            return redirect()->back()->with('error', 'Device Not connected');
        }

    }

}
