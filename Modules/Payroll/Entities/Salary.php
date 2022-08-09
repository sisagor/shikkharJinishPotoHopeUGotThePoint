<?php

namespace Modules\Payroll\Entities;

use App\Models\RootModel;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;


class Salary extends RootModel
{
    use SoftDeletes;

    protected $table = 'salaries';

    const IS_PAID = 2;
    const IS_PARTIAL_PAID = 1;
    const IS_NOT_PAID = 0;

    protected $casts = [
        'details' => 'array',
    ];

    protected $fillable = [
        'id', 'com_id', 'branch_id', 'salary_rule_id', 'employee_id', 'basic_salary',
        'details', 'total', 'is_paid', 'paid_amount', 'due_amount', 'month', 'tax', 'other_allowance', 'other_deduction',
        'approval_status', 'allowance', 'deduction'
    ];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function salaryRule()
    {
        return $this->belongsTo(SalaryRule::class, 'salary_rule_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }


}
