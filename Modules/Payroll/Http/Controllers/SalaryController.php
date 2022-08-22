<?php

namespace Modules\Payroll\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Modules\Payroll\Entities\Salary;
use Modules\Payroll\Entities\SalaryRule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Payroll\Entities\SalaryRuleStructure;
use Modules\Payroll\Http\Requests\SalaryPayCreateRequest;
use Modules\Payroll\Http\Requests\SalaryRuleCreateRequest;
use Modules\Payroll\Repositories\SalaryRepositoryInterface;

class SalaryController extends Controller
{
    protected $repository;

    public function __construct(SalaryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /** Pending salaries*/
    public function pendingSalaries(Request $request)
    {
        if (! $request->ajax()) {
            return view('payroll::salary.index');
        }

        $data = $this->repository->getPendingSalaries($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->escapeColumns('is_paid')
            ->editColumn('total', function ($row) {
                return get_formatted_currency($row->total, 2);
            })
            ->editColumn('allowance', function ($row) {
                return get_formatted_currency($row->allowance, 2);
            })
            ->editColumn('deduction', function ($row) {
                return get_formatted_currency($row->deduction, 2);
            })
            ->editColumn('other_allowance', function ($row) {
                return get_formatted_currency($row->other_allowance, 2);
            })
            ->editColumn('other_deduction', function ($row) {
                return get_formatted_currency($row->other_deduction, 2);
            })
            ->editColumn('basic_salary', function ($row) {
                return get_formatted_currency($row->basic_salary, 2);
            })
            ->editColumn('paid_amount', function ($row) {
                return get_formatted_currency($row->paid_amount, 2);
            })
            ->editColumn('due_amount', function ($row) {
                return get_formatted_currency($row->due_amount, 2);
            })
            ->editColumn('month', function ($row) {
                return (\Carbon\Carbon::parse($row->month))->format('F-Y');
            })
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="ajax-modal-btn btn btn-success " data-link="'.route('payroll.salary.approve', $row).'">Approve</a>'. delete_button('payroll.salary.delete', $row);
            })
            ->make(true);

    }

    /** Approved salaries*/
    public function approvedSalaries(Request $request)
    {
        if (! $request->ajax()) {
            return view('payroll::salary.approved');
        }

        $data = $this->repository->getApprovedSalaries($request);

        return DataTables::of($data)
            ->addIndexColumn()
            //->setTotalRecords(get_total_count('salaries', \request()))
            ->editColumn('is_paid', function ($row) {
                return salary_paid_status($row->is_paid);
            })
            ->escapeColumns('is_paid')
            ->editColumn('other_allowance', function ($row) {
                return get_formatted_currency($row->other_allowance, 2);
            })
            ->editColumn('other_deduction', function ($row) {
                return get_formatted_currency($row->other_deduction, 2);
            })
            ->editColumn('total', function ($row) {
                return get_formatted_currency($row->total, 2);
            })
            ->editColumn('basic_salary', function ($row) {
                return get_formatted_currency($row->basic_salary, 2);
            })
            ->editColumn('paid_amount', function ($row) {
                return get_formatted_currency($row->paid_amount, 2);
            })
            ->editColumn('due_amount', function ($row) {
                return get_formatted_currency($row->due_amount, 2);
            })
            ->editColumn('month', function ($row) {
                return (Carbon::parse($row->month))->format('F-Y');
            })
            ->addColumn('action', function ($row) {
                $payment = has_permission('payroll.salary.export') && $row->is_paid != Salary::IS_NOT_PAID ?
                    ' <a href="javascript:void(0)" data-link="' . route('payroll.salary.payslip', $row) . '" class="ajax-modal-btn btn btn-info">
                        <i class="fa fa-file-pdf-o"></i>
                    </a> '
                    : '';
                return '<a href="javascript:void(0)" class="ajax-modal-btn btn btn-success " data-link="'.route('payroll.salary.view', $row).'">View</a>' . $payment;
            })
            ->make(true);
    }

    /**
     * Employees Salary Generation:
     */
    public function salaryGenerate(Request $request)
    {
        set_action('payroll.salaryGenerate.store');
        set_action_title('salary_generation');

        return view('payroll::salary.salaryGenerate');
    }

    /**
     * Employees Salary Generation Store:
     */
    public function salaryGenerateStore(Request $request)
    {
        if (Artisan::call('salaryGenerate', ['month' => $request->get('month'), 'employee' => $request->get('employee')])) {
            //sendActivityNotification(trans('msg.noty.approved', ['model' => trans('model.salary')]));
            return redirect()->back()->with('success', trans('msg.generate_success', ['model' => trans('model.salary')]));
        }

        return redirect()->back()->with('error', trans('msg.generate_failed', ['model' => trans('model.salary')]));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editSalary(Salary $salary): Renderable
    {
        set_action('payroll.salary.approve.update', $salary);
        set_action_title('salary_approval');
        set_action_button('approve');

        return view('payroll::salary.edit', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function approveSalary(Request $request, Salary $salary): RedirectResponse
    {
        $update = $this->repository->salaryUpdate($request, $salary);

        if ($update) {

            sendActivityNotification(trans('msg.noty.approved', ['model' => trans('model.salary')]));

            return redirect()->back()->with('success', trans('msg.approve_success', ['model' => trans('model.salary')]));
        }

        return redirect()->back()->with('error', trans('msg.approve_failed', ['model' => trans('model.salary')]));

    }

    /**
     * View  Salary:
     */
    public function viewSalary(Salary $salary)
    {
        set_action('payroll.salaryPay', $salary);
        set_action_title('salary_details_payment');
        $salary = $this->repository->getSalary($salary);

        return view('payroll::salary.show', compact('salary'));
    }

    /* store salary payment*/
    public function salaryPayStore(SalaryPayCreateRequest $request, Salary $salary)
    {

        $payment = $this->repository->salaryPayStore($request, $salary);

        if ($payment) {

            return redirect()->back()->with('success', trans('msg.salary_paid', ['model' => trans('model.salary')]));
        }

        return redirect()->back()->with('error', trans('msg.salary_paid', ['model' => trans('model.salary')]));

    }


    /* store salary payment*/
    public function payslip(Salary $salary)
    {
        return view('payroll::salary.payslip', compact('salary'));
    }

    /* store salary payment*/
    public function payslipPrint(Salary $salary)
    {
        return view('payroll::salary.payslipPrint', compact('salary'));
    }

    /* delete pending salary*/
    public function deleteSalary(Salary $salary) : RedirectResponse
    {
        $delete = $this->repository->deleteSalary($salary);

        if ($delete)
        {
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.salary')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.salary')]));
    }

}
