<?php

namespace Modules\Payroll\Entities;

use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;

class Insurance extends RootModel
{

    protected $table = 'insurance';


    protected $fillable = [
        'id', 'com_id', 'branch_id', 'employee_id', 'employee_index', 'employee_name', 'employee_amount',
        'company_amount', 'total', 'maturity_date', 'month',
    ];

    public static $fecth = [
        'id', 'com_id', 'branch_id', 'employee_id', 'employee_index', 'employee_name', 'employee_amount',
        'company_amount', 'maturity_date', 'total', 'month',
    ];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }


}
