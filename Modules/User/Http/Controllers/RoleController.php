<?php

namespace Modules\User\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\RoleCreateRequest;
use Modules\User\Http\Requests\RoleUpdateRequest;
use Modules\User\Repositories\RoleRepositoryInterface;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    protected $repo;
    protected $model;

    public function __construct(RoleRepositoryInterface $roleRepository, Role $role)
    {
        $this->repo = $roleRepository;
        $this->model = $role;
    }

    public function index(Request $request)
    {
        if(! $request->ajax()){
            return view('user::role.index');
        }

        $data = $this->repo->all();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('level', function ($row) {
                    return   get_role_level($row->level);
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button($row) . trash_button($row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }


        if ($request->get('type') == "trash"){
            $trash = $data->onlyTrashed();

            return DataTables::of($trash)
                ->addIndexColumn()
                ->editColumn('level', function ($row) {
                    return   get_role_level($row->level);
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

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action('userManagements.role.store');
        set_action_title('new_role');

        $modules = $this->getModules();
        $role = null;

        return view('user::role.newEdit', compact('role', 'modules'));
    }


    /**
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleCreateRequest $request): RedirectResponse
    {
        if ($this->repo->store($request)) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.role')]));

            return redirect()->route('userManagements.roles')->with('success', trans('msg.create_success', ['model' => trans('model.role')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.role')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(): Renderable
    {
        return view('user::role.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        set_action('userManagements.role.update', $id);
        set_action_title('edit_role');

        $role = $this->repo->find($id);

        $modules = $this->getModules();


        return view('user::role.newEdit', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        if ($this->repo->update($request, $id)) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.role')]));

            return redirect()->route('userManagements.roles')->with('success', trans('msg.update_success', ['model' => trans('model.role')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.role')]));

    }

    /**
     * soft delete
     * @param int $id
     * @return RedirectResponse
     */
    public function trash($id): RedirectResponse
    {
        if ($this->repo->trash($id)) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.role')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.role')]));
        }

        return redirect()->back()->with('success', trans('msg.soft_delete_failed', ['model' => trans('model.role')]));
    }

    /**
     * restore data
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        if ($this->repo->restore($id)) {
            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.role')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.role')]));
        }

        return redirect()->back()->with('success', trans('msg.restore_failed', ['model' => trans('model.role')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        if ($this->repo->destroy($id)) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.role')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.role')]));
        }

        return redirect()->back()->with('success', trans('msg.delete_failed', ['model' => trans('model.role')]));
    }

    /**get modules according to role*/
    protected function getModules()
    {
        if (is_branch_admin()) {
            return branch_modules();
        }

        if (is_company_admin()) {
            return company_modules();
        }

        if (is_admin_group()) {

            return Module::active()->orderBy('order', 'asc')->get();
        }
    }


}
