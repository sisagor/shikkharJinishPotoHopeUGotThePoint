<?php

namespace Modules\Company\Http\Controllers;

use App\Models\User;
use App\Services\ZKTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Company\Entities\Company;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Company\Http\Requests\CompanyCreateRequest;
use Modules\Company\Http\Requests\CompanyUpdateRequest;
use Modules\Company\Repositories\CompanyRepositoryInterface;
use Modules\Company\Http\Requests\CompanyProfileUpdateRequest;
use Modules\Company\Http\Requests\CompanySettingsUpdateRequest;



class CompanyController extends Controller
{

    /**
     * Repository property hold company repository object
     */
    protected $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * All companies
     */
    public function index(Request $request)
    {
        $data = $this->repository->all();

        if (! $request->ajax()){
            return view('company::index');
        }

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('role', function ($row) {
                    return (! empty($row->user) ? $row->user->role->name : null);
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('company.company.edit', $row) . trash_button('company.company.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            $trash = $this->repository->trashOnly();

            return DataTables::of($trash)
                ->addIndexColumn()
                ->editColumn('role', function ($row) {
                    return (! empty($row->user) ? $row->user->role->name : null);
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('company.company.restore', $row) . delete_button('company.company.delete', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    /**
     * Create Companies
     */
    public function create(): Renderable
    {
        set_action('company.company.store');
        set_action_title('new_company');

        $company = [];

        return view('company::newEdit', compact('company'));
    }

    /**
     * store company
     */
    public function store(CompanyCreateRequest $request): RedirectResponse
    {

        $company = $this->repository->store($request);

        if ($company) {
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.company')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.company')]));

    }

    /**
     * Edit company
     */
    public function edit(Company $company): Renderable
    {

        set_action('company.company.update', $company);
        set_action_title('update_company');

        return view('company::newEdit', compact('company'));

    }

    /**
     * Update company
     */
    public function update(CompanyUpdateRequest $request, Company $company): RedirectResponse
    {

        $update = $this->repository->update($request, $company);

        if ($update) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.company')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.company')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.company')]));
    }


    /**
     * soft delete company
     */
    public function trash(Company $company): RedirectResponse
    {
        $delete =$company->delete();

        if ($delete) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.company')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.company')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.company')]));
    }

    /**
     * restore company
     */
    public function restore($company): RedirectResponse
    {
        $user = User::onlyTrashed()->where('com_id', $company)->restore();
        $com = $this->repository->restore($company);

        if ($user &&  $com) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.company')]));
            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.company')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.company')]));
    }

    /**
     * Delete company
     */
    public function destroy($company): RedirectResponse
    {
        $delete = $this->repository->destroyTrash($company);

        if ($delete) {

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.company')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.company')]));
    }


    /**company profile*/
    public function profile(Company $company): Renderable
    {
        set_action('company.company.profile.update', $company);
        return view('company::profile', compact('company'));
    }

    /**
     * prrofile company
     * @return RedirectResponse
     */
    public function profileUpdate(CompanyProfileUpdateRequest $request, Company $company): RedirectResponse
    {

        $update = $this->repository->updateProfile($request, $company);

        if ($update) {
            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.company')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.company')]));
    }


    /**
     * Company settings
     */

    public function settings(): Renderable
    {
        //dd(config('company_settings'));
        return view('company::settings.settings');
    }


    /**
     * @param CompanySettingsUpdateRequest $request
     * @return RedirectResponse
     */
    public function settingsUpdate(CompanySettingsUpdateRequest $request): RedirectResponse
    {
        $update = $this->repository->updateSettings($request);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.company_setting')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.company_setting')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.company_setting')]));
    }


    public function deviceTest()
    {
        $service = new ZKTService(get_device_ip());

        try {

            if ($service->connect()) {
                return redirect()->back()->with('success', 'Device connected');
            }

        }catch (\Exception $exception){

            //dd($exception);
            Log::error('Device Connect Error');
            Log::error(get_exception_message($exception));

            return redirect()->back()->with('error', 'Device Not connected');
        }

    }


}
