<?php

namespace Modules\Payroll\Repositories;

use App\Common\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\Payroll\Entities\Salary;
use App\Repositories\EloquentRepository;


class SalaryRepository extends EloquentRepository implements SalaryRepositoryInterface
{
    public $model;

    public function __construct(Salary $rule)
    {
        $this->model = $rule;
    }

    /**common query for salaries*/
    public function salaries()
    {
        return Salary::join('employees', 'employees.id', 'salaries.employee_id')->select('employees.name', 'employees.employee_index', 'salaries.*');
    }

    /** get Pending salaries*/
    public function getPendingSalaries(Request $request)
    {
        $query = $this->salaries()->where('salaries.approval_status', '!=', Salary::APPROVAL_STATUS_PENDING);
        return (new Filter($request, $query))->commonScopeFilter(['com_id' => 'salaries.com_id', 'branch_id' => 'salaries.branch_id'])
             ->departmentScopeFilter(['department_id' => 'employees.department_id'])
             ->employeeScopeFilter(['employee_id' => 'employees.id'])
             ->monthFilter(['month' => 'salaries.salary_month'])
             ->execute();

    }

    /** get Approved salaries*/
    public function getApprovedSalaries(Request $request)
    {
        $query = $this->salaries()->where('approval_status', Salary::APPROVAL_STATUS_APPROVED);
        return (new Filter($request, $query))->commonScopeFilter(['com_id' => 'salaries.com_id', 'branch_id' => 'salaries.branch_id'])
            ->departmentScopeFilter(['department_id' => 'employees.department_id'])
            ->employeeScopeFilter(['employee_id' => 'employees.id'])
            ->monthFilter(['month' => 'salaries.salary_month'])
            ->execute();

    }


    /**
     * get single salary details:
     */
    public function getSalary(Salary $salary)
    {
        return Salary::with(['employee' => function ($employee) {
            $employee->select('id', 'department_id', 'designation_id')
                ->with('department:id,name')
                ->with('designation:id,name');
        }])->where('id', $salary->id)->first();
    }

    //Pay salary
    public function salaryPayStore(Request $request, Salary $salary)
    {
        try {

            if ($salary->due_amount > $request->get('amount')) {
                $due = ($salary->due_amount - $request->get('amount'));
                $paidAmount = ($request->get('amount') + $salary->paid_amount);
                $status = Salary::IS_PARTIAL_PAID;
            }
            else {
                $due = 0;
                $paidAmount = ($request->get('amount') + $salary->paid_amount);
                $status = Salary::IS_PAID;
            }

            $salary->update([
                'paid_amount' => $paidAmount,
                'is_paid' => $status,
                'due_amount' => $due,
                'paid_by' => Auth::id()
            ]);

        } catch (\Exception $exception) {
            Log::error('Salary payment Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;

    }


    //update salary
    public function salaryUpdate(Request $request, Salary $salary)
    {
        try {
            $allowance = (float)$request->get('other_allowance');
            $deduction= (float)$request->get('other_deduction');

            $salary->update([
                'other_allowance' => $allowance,
                'other_deduction' => $deduction,
                'total' => (($salary->total + $allowance) - $deduction),
                'due_amount' => (($salary->total + $allowance) - $deduction),
                'approval_status' => Salary::APPROVAL_STATUS_APPROVED
            ]);

        } catch (\Exception $exception) {
            Log::error('Salary update Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;

    }

    /*Delete pending salary*/
    public function deleteSalary(Salary $salary) : int
    {
        try
        {
            $salary->forceDelete();
        }
        catch (\Exception $exception){
            Log::error('Salary Delete Error');
            Log::info(get_exception_message($exception));

            return false;
        }

        return true;
    }
}
