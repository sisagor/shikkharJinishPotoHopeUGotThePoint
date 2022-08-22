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

    public function all()
    {
        return $this->model->mine();

    }


    /*Store Company*/
    public function store(Request $request): bool
    {
        $addTypes = $request->get('add_type');
        $addPercent = $request->get('add_percent') ?? [];

        $deductTypes = $request->get('deduct_type');
        $deductPercent = $request->get('deduct_percent') ?? [];

        $providentTypes = $request->get('provident_type');
        $providentPercent = $request->get('provident_percent') ?? [];

        $insuranceTypes = $request->get('insurance_type');
        $insurancePercent = $request->get('insurance_percent') ?? [];

        $overtimeTypes = $request->get('overtime_type');
        $overtimePercent = $request->get('overtime_percent') ?? [];

        try {

            DB::beginTransaction();

            $rule = $this->model->create([
                'name' => $request->get('name'),
                'designation_id' => $request->get('designation_id'),
                'basic_salary' => $request->get('basic_salary'),
                'details' => $request->get('details'),
                'status' => $request->get('status'),
            ]);

            //Add type total with percent;
            if (isset($addTypes)) {
                foreach ($addTypes as $key => $value) {
                    if (! empty($value)) {
                        $rule->salaryRuleStructure()->create([
                            'salary_structure_id' => $key,
                            'is_percent' => (array_key_exists($key, $addPercent) ?? 0),
                            'amount' => $value,
                        ]);
                    }
                }
            }

            //Deduct type total  with percent;
            if (isset($deductTypes)) {
                foreach ($deductTypes as $key => $value) {
                    if (! empty($value)) {
                        $rule->salaryRuleStructure()->create([
                            'salary_structure_id' => $key,
                            'is_percent' => (array_key_exists($key, $deductPercent) ?? 0),
                            'amount' => $value,
                        ]);
                    }
                }
            }

            //Provident  type total with percent;
            if (isset($providentTypes)) {
                foreach ($providentTypes as $key => $value) {
                    if (! empty($value)) {
                        $rule->salaryRuleStructure()->create([
                            'salary_structure_id' => $key,
                            'is_percent' => (array_key_exists($key, $providentPercent) ?? 0),
                            'amount' => $value,
                        ]);
                    }
                }
            }

            //Provident  type total with percent;
            if (isset($insuranceTypes)) {
                foreach ($insuranceTypes as $key => $value) {
                    if (! empty($value)) {
                        $rule->salaryRuleStructure()->create([
                            'salary_structure_id' => $key,
                            'is_percent' => (array_key_exists($key, $insurancePercent) ?? 0),
                            'amount' => $value,
                        ]);
                    }
                }
            }

            //overtime  type total with percent;
            if (isset($overtimeTypes)) {
                foreach ($overtimeTypes as $key => $value) {
                    if (! empty($value)) {
                        $rule->salaryRuleStructure()->create([
                            'salary_structure_id' => $key,
                            'is_percent' => (array_key_exists($key, $overtimePercent) ?? 0),
                            'amount' => $value,
                        ]);
                    }
                }
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error("Salary rule create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*Update Branch*/
    public function update(Request $request, $model): bool
    {

        $addTypes = $request->get('add_type');
        $addPercent = $request->get('add_percent') ?? [];

        $deductTypes = $request->get('deduct_type');
        $deductPercent = $request->get('deduct_percent') ?? [];

        $providentTypes = $request->get('provident_type');
        $providentPercent = $request->get('provident_percent') ?? [];

        $insuranceTypes = $request->get('insurance_type');
        $insurancePercent = $request->get('insurance_percent') ?? [];

        $overtimeTypes = $request->get('overtime_type');
        $overtimePercent = $request->get('overtime_percent') ?? [];

        try {

            DB::beginTransaction();

            $model->update([
                'name' => $request->get('name'),
                'designation_id' => $request->get('designation_id'),
                'basic_salary' => $request->get('basic_salary'),
                'details' => $request->get('details'),
                'status' => $request->get('status'),
            ]);

            if ($model->salaryRuleStructure) {
                foreach ($model->salaryRuleStructure as $item) {
                    $item->forceDelete();
                }
            }

            //Add type total with percent;
            if (isset($addTypes)) {
                foreach ($addTypes as $key => $value) {
                    if (! empty($value)) {
                        $model->salaryRuleStructure()->updateOrCreate(
                            ['salary_rule_id' => $model->id, 'salary_structure_id' => $key],
                            [
                                'salary_structure_id' => $key,
                                'is_percent' => (array_key_exists($key, $addPercent) ?? 0),
                                'amount' => $value,
                            ]
                        );
                    }
                }
            }

            //Deduct type total  with percent;
            if (isset($deductTypes)) {
                foreach ($deductTypes as $key => $value) {
                    if (! empty($value)) {
                        $model->salaryRuleStructure()->updateOrCreate(
                            ['salary_rule_id' => $model->id, 'salary_structure_id' => $key],
                            [
                                'salary_structure_id' => $key,
                                'is_percent' => (array_key_exists($key, $deductPercent) ?? 0),
                                'amount' => $value,
                            ]
                        );
                    }
                }
            }

            //Provident  type total with percent;
            if (isset($providentTypes)) {
                foreach ($providentTypes as $key => $value) {
                    if (! empty($value)) {
                        $model->salaryRuleStructure()->updateOrCreate(
                            ['salary_rule_id' => $model->id, 'salary_structure_id' => $key],
                            [
                                'salary_structure_id' => $key,
                                'is_percent' => (array_key_exists($key, $providentPercent) ?? 0),
                                'amount' => $value,
                            ]
                        );
                    }
                }
            }

            //Provident  type total with percent;
            if (isset($insuranceTypes)) {
                foreach ($insuranceTypes as $key => $value) {
                    if (! empty($value)) {
                        $model->salaryRuleStructure()->updateOrCreate(
                            ['salary_rule_id' => $model->id, 'salary_structure_id' => $key],
                            [
                                'salary_structure_id' => $key,
                                'is_percent' => (array_key_exists($key, $insurancePercent) ?? 0),
                                'amount' => $value,
                            ]
                        );
                    }
                }
            }

            //overtime  type total with percent;
            if (isset($overtimeTypes)) {
                foreach ($overtimeTypes as $key => $value) {
                    if (! empty($value)) {
                        $model->salaryRuleStructure()->updateOrCreate(
                            ['salary_rule_id' => $model->id, 'salary_structure_id' => $key],
                            [
                                'salary_structure_id' => $key,
                                'is_percent' => (array_key_exists($key, $overtimePercent) ?? 0),
                                'amount' => $value,
                            ]
                        );
                    }
                }
            }

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();
            Log::error("Salary rule create Failed");
            Log::info(get_exception_message($exception));

            return false;
        }

        return true;
    }


    public function destroy($model): bool
    {
        try {

            DB::beginTransaction();

            foreach ($model->salaryRuleStructure as $item) {
                $item->forceDelete();
            }

            $model->forceDelete();

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Delete Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;

    }


    /**common query for salaries*/
    public function salaries()
    {
        return Salary::join('employees', 'employees.id', 'salaries.employee_id')->select('employees.first_name', 'employees.last_name', 'employees.employee_index', 'salaries.*');
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
