<?php

namespace Modules\Payroll\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Payroll\Entities\SalaryStructure;
use Modules\Payroll\Http\Requests\SalaryStructureCreateRequest;
use Modules\Payroll\Http\Requests\SalaryStructureUpdateRequest;


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
    public function index()
    {
        $structures = $this->model->companyScope()->get();
        return view('payroll::structure.index', compact('structures'));
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
     * @return Renderable
     */
    public function store(SalaryStructureCreateRequest $request)
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
    public function edit(SalaryStructure $structure)
    {
        set_action('payroll.structure.update', $structure);
        set_action_title('update_component');

        return view('payroll::structure.newEdit', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SalaryStructureUpdateRequest $request, SalaryStructure $structure)
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
     * @return Renderable
     */
    public function destroy(SalaryStructure $structure)
    {
        if ($structure->forceDelete()) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.salary_structure')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.salary_structure')]));
        }

        return redirect()->back()->with('success', trans('msg.delete_failed', ['model' => trans('model.salary_structure')]));
    }


}
