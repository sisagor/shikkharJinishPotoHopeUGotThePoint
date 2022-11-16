<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use Modules\Organization\Entities\Department;
use Modules\Organization\Entities\Designation;
use Modules\Organization\Http\Requests\DepartmentCreateRequest;
use Modules\Organization\Http\Requests\DepartmentUpdateRequest;
use Modules\Organization\Repositories\DesignationRepositoryInterface;
use Modules\Organization\Repositories\OrganizationRepositoryInterface;


class OrganizationController extends Controller
{
    protected $department;
    protected $designation;

    public function __construct(OrganizationRepositoryInterface $department, DesignationRepositoryInterface $designation)
    {
        $this->department = $department;
        $this->designation = $designation;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function departments(): Renderable
    {
        $departments = $this->department->all();

        return view('organization::department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createDepartment(): Renderable
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
    public function storeDepartment(DepartmentCreateRequest $request): RedirectResponse
    {
        $create = $this->department->store($request);

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
    public function editDepartment(Department $department): Renderable
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
    public function updateDepartment(DepartmentUpdateRequest $request, Department $department): RedirectResponse
    {
        $update = $this->department->update($request, $department);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.department')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.department')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.department')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroyDepartment(Department $department): RedirectResponse
    {
        $delete = $this->department->destroy($department);

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.department')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.department')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.department')]));

    }


    /**
     * Designations
     * @return Renderable
     */
    public function designations(): Renderable
    {
        $designations = $this->designation->all();
        return view('organization::designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createDesignation(): Renderable
    {
        set_action('organization.designation.store');
        set_action_title('new_designation');
        $designation = [];
        return view('organization::designation.newEdit', compact('designation'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeDesignation(Request $request): RedirectResponse
    {
        $create = $this->designation->store($request);

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.designation')]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editDesignation(Designation $designation): Renderable
    {
        set_action('organization.designation.update', $designation);
        set_action_title('edit_designation');

        return view('organization::designation.newEdit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateDesignation(Request $request, Designation $designation): RedirectResponse
    {
        $update = $this->designation->update($request, $designation);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.designation')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroyDesignation(Designation $designation): RedirectResponse
    {
        $delete = $this->designation->destroy($designation);

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.designation')]));
    }


    /**
     * Return JsonResponse
     */
    public function getDesignations(Request $request): \Illuminate\Http\JsonResponse
    {
        $designations = Designation::where('department_id', $request->get('id'))
            ->select('id', 'name as text')->get()->toArray();

        if ($designations) {
            return response()->json($designations);
        }

        return response()->json(['id' => '0', 'text' => 'No designation found']);
    }
}
