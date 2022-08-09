<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Organization\Entities\Department;
use Modules\Organization\Repositories\DepartmentRepository;
use Modules\Organization\Http\Requests\DepartmentCreateRequest;
use Modules\Organization\Http\Requests\DepartmentUpdateRequest;


class DepartmentController extends Controller
{
    //Assign the repository
    protected $repo;

    public function __construct(DepartmentRepository $department)
    {
        $this->repo = $department;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(! $request->ajax()){
            return view('organization::department.index');
        }

        $data = $this->repo->all();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
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
            $trash = $data->onlyTrashed();

            return DataTables::of($trash)
                ->addIndexColumn()
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
    public function create(): Renderable
    {
        set_action('organization.department.store');
        set_action_title('new_department');
        $department = [];
        return view('organization::department.newEdit', compact('department'));
    }


    /**
     * @param DepartmentCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DepartmentCreateRequest $request): RedirectResponse
    {
        $create = $this->repo->store($request);

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.department')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.department')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.department')]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Department $department): Renderable
    {
        set_action('organization.department.update', $department);
        set_action_title('edit_department');

        return view('organization::department.newEdit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(DepartmentUpdateRequest $request, Department $department): RedirectResponse
    {
        $update = $this->repo->update($request, $department);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.department')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.department')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.department')]));
    }

    /**
     * Trash
     * @param int $id
     * @return RedirectResponse
     */
    public function trash($department): RedirectResponse
    {
        if ( $this->repo->trash($department)) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.department')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.department')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.department')]));
    }


    /**
     * Restore
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($department): RedirectResponse
    {
        if ($this->repo->restore($department)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.department')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.department')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.department')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($department): RedirectResponse
    {
        if ($this->repo->destroyTrash($department)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.department')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.department')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.department')]));

    }



}
