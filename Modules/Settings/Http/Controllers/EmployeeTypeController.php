<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Entities\EmployeeType;
use Modules\Settings\Http\Requests\EmployeeTypeCreateRequest;
use Modules\Settings\Http\Requests\EmployeeTypeUpdateRequest;


class EmployeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if(! $request->ajax()){
            return view('settings::employmentType.index');
        }

        if ($request->get('type') == "active"){

            return DataTables::of(EmployeeType::commonScope()->select(EmployeeType::$fetch))
                ->addIndexColumn()
                ->editColumn('allow_company_facility', function ($row) {
                    $facility = "No";
                    if (\Modules\Settings\Entities\EmployeeType::COMPANY_FACILITY_ALLOW == $row->allow_company_facility){
                        $facility = "Yes";
                    }
                    return $facility;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('componentSettings.employmentType.edit', $row) . trash_button('componentSettings.employmentType.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }


        if ($request->get('type') == "trash"){

            return DataTables::of(EmployeeType::commonScope()->select(EmployeeType::$fetch)->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('allow_company_facility', function ($row) {
                    $facility = "No";
                    if (\Modules\Settings\Entities\EmployeeType::COMPANY_FACILITY_ALLOW == $row->allow_company_facility){
                        $facility = "Yes";
                    }
                    return $facility;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('componentSettings.employmentType.restore', $row) . delete_button('componentSettings.employmentType.delete', $row);
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
        set_action('componentSettings.employmentType.store');
        set_action_title('new_employment_type');

        $type = [];

        return view('settings::employmentType.newEdit', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(EmployeeTypeCreateRequest $request): RedirectResponse
    {
        $create = EmployeeType::create($request->all());

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.employee_type')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.employee_type')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.employee_type')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        return view('employee::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(EmployeeType $type): Renderable
    {
        set_action('componentSettings.employmentType.update', $type);
        set_action_title('edit_employment_type');

        return view('settings::employmentType.newEdit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(EmployeeTypeUpdateRequest $request, EmployeeType $type): RedirectResponse
    {
        $update = $type->update($request->all());

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.employee_type')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.employee_type')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.employee_type')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(EmployeeType $type): RedirectResponse
    {
        $delete = $type->delete();

        if ($delete) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.employee_type')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.employee_type')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.employee_type')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($type): RedirectResponse
    {
        $delete =  EmployeeType::withTrashed()->find($type)->forceDelete();

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.employee_type')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.employee_type')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.employee_type')]));
    }

    public function restore($type): RedirectResponse
    {
        $restore = EmployeeType::withTrashed()->find($type)->restore();

        if ($restore) {
            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.employee_type')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.employee_type')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.employee_type')]));
    }

}
