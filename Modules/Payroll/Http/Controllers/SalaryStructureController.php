<?php

namespace Modules\Payroll\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use Modules\Payroll\Entities\SalaryStructure;
use Modules\Payroll\Http\Requests\SalaryStructureCreateRequest;
use Modules\Payroll\Http\Requests\SalaryStructureUpdateRequest;
use Yajra\DataTables\Facades\DataTables;


class SalaryStructureController extends Controller
{
    protected $model;

    public function __construct(SalaryStructure $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('payroll::structure.index');
        }

        $data = $this->model->companyScope();

        if($request->get('type') == "active") {


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return edit_button('payroll.structure.edit', $row) . trash_button('payroll.structure.trash', $row);
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        if($request->get('type') == "trash") {

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    return restore_button('payroll.structure.restore', $row) . delete_button('payroll.structure.delete', $row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action('payroll.structure.store');
        set_action_title('new_component');
        $structure = [];
        return view('payroll::structure.newEdit', compact('structure'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(SalaryStructureCreateRequest $request): RedirectResponse
    {
        $create = $this->model->create($request->validated());

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.salary_structure')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.salary_structure')]));
        }

        return redirect()->back()->with('success', trans('msg.create_failed', ['model' => trans('model.salary_structure')]));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(SalaryStructure $structure): Renderable
    {
        set_action('payroll.structure.update', $structure);
        set_action_title('update_component');

        return view('payroll::structure.newEdit', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SalaryStructureUpdateRequest $request, SalaryStructure $structure): RedirectResponse
    {
        $update = $structure->update($request->validated());

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.salary_structure')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.salary_structure')]));
        }

        return redirect()->back()->with('success', trans('msg.update_failed', ['model' => trans('model.salary_structure')]));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(SalaryStructure $structure): RedirectResponse
    {
        if ($structure->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.salary_structure')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.salary_structure')]));
        }

        return redirect()->back()->with('success', trans('msg.soft_delete_failed', ['model' => trans('model.salary_structure')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($structure): RedirectResponse
    {
        if (SalaryStructure::onlyTrashed()->find($structure)->restore()) {

            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.salary_structure')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.salary_structure')]));
        }

        return redirect()->back()->with('success', trans('msg.restore_failed', ['model' => trans('model.salary_structure')]));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($structure): RedirectResponse
    {
        if (SalaryStructure::onlyTrashed()->find($structure)->forceDlete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.salary_structure')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.salary_structure')]));
        }

        return redirect()->back()->with('success', trans('msg.delete_failed', ['model' => trans('model.salary_structure')]));
    }


}
