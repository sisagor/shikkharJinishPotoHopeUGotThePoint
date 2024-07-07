<?php

namespace Modules\Payroll\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Payroll\Entities\SalaryRule;
use Illuminate\Contracts\Support\Renderable;
use Modules\Payroll\Entities\SalaryStructure;
use Modules\Payroll\Entities\SalaryRuleStructure;
use Modules\Payroll\Http\Requests\SalaryRuleCreateRequest;
use Modules\Payroll\Repositories\PayrollRepositoryInterface;


class PayrollController extends Controller
{
    protected $repository;

    public function __construct(PayrollRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('payroll::rule.index');
        }

        //Pay rules
        $data = $this->repository->all();

        if($request->get('type') == "active") {


            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('basic_salary', function($row){
                    return get_formatted_currency($row->basic_salary, 2);
                })
                ->editColumn('status', function($row){
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('payroll.rule.edit', $row, 0) . trash_button('payroll.rule.trash', $row);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);

        }

        if($request->get('type') == "trash") {

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('basic_salary', function($row){
                    return get_formatted_currency($row->basic_salary, 2);
                })
                ->editColumn('status', function($row){
                    return get_status($row->status);
                })
                ->addColumn('action', function($row) {
                    return restore_button('payroll.rule.restore', $row) . delete_button('payroll.rule.delete', $row);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        set_action('payroll.rule.store');
        set_action_title('new_salary_rule');
        $rule = [];
        return view('payroll::rule.newEdit', compact('rule'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(SalaryRuleCreateRequest $request): RedirectResponse
    {
        $create = $this->repository->store($request);

        if ($create) {

            return redirect()->route('payroll.rules')->with('success', trans('msg.create_success', ['model' => trans('model.salary_rule')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.salary_rule')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(SalaryRule $rule): Renderable
    {
        $title = "salary_rule_details";

        $structures = SalaryRuleStructure::with('salaryStructure')->where('salary_rule_id', $rule->id)->get();

        return view('payroll::rule.show', compact('rule', 'title', 'structures'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(SalaryRule $rule): Renderable
    {
        set_action('payroll.rule.update', $rule);
        set_action_title('edit_salary_rule');

        return view('payroll::rule.newEdit', compact('rule'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SalaryRuleCreateRequest $request, SalaryRule $rule): RedirectResponse
    {
        $update = $this->repository->update($request, $rule);

        if ($update) {
            return redirect()->route('payroll.rules')->with('success', trans('msg.update_success', ['model' => trans('model.salary_rule')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.salary_rule')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(SalaryRule $rule): RedirectResponse
    {

        if ($rule->delete()) {

            sendActivityNotification(trans('msg.noty.soft_delete', ['model' => trans('model.salary_rule')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.salary_rule')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.salary_rule')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($rule): RedirectResponse
    {
        if ($this->repository->restore($rule)) {
            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.salary_rule')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.salary_rule')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.salary_rule')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($rule): RedirectResponse
    {
        if ($this->repository->destroy($rule)) {

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.salary_rule')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.salary_rule')]));
    }

    /**
     * Remove show the rule details when select rule.
     * @param int $id
     * @return RedirectResponse
     */
    public function gradeWiseRule(Request $request)
    {
        if (! $request->ajax()) {

            $rules = SalaryRule::active()->pluck('name', 'id');
            $structures = SalaryStructure::active()->get();
            $rule = [];

            return view('payroll::rule.showGradeWise', compact('rules', 'structures', 'rule'));
        }

        if (! $request->get('type') || ! $request->get('rule_id')){
            return response()->json(['status' => 0, 'msg' => 'Please select type and year'], 200);
        }

        $rule = SalaryRule::where('id', $request->get('rule_id'))->with('salaryRuleStructure')->with('salaryRuleStructure.salaryStructure')->first();

        $basic = $rule->basic_salary;

        //var_dump($rule->basic_salary);
        //var_dump($rule->increment_amount);
        //var_dump($request->get('year'));
        //dd($request->all());

        if (config('company_settings.has_increment') && $request->get('type') == config('payroll.increment_key.increment'))
        {
            $basic = ($basic + ($rule->increment_amount * $request->get('year')));
        }


        if (config('company_settings.has_efficient_bar') && $request->get('type') == config('payroll.increment_key.efficient_bar'))
        {
            $increment = ($rule->increment_amount * config('company_settings.increment_year'));

            $basic = ($basic + $increment + ($rule->efficient_bar_amount * $request->get('year')));

        }

        $tax = 0;

        if (config('company_settings.has_tax_policy'))
        {
            $tax = tax_calculation($basic);
        }

        //dd($rule->basic_salary);

        $view = view('payroll::rule.partials.ruleDetails', compact('basic', 'rule', 'tax'))->render();
        $total = view('payroll::rule.partials.ruleTotal', compact('basic', 'rule', 'tax'))->render();

        return response()->json(['status' => 1, 'data' => $view, 'total' => $total]);


    }

}
