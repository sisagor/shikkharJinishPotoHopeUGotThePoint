<?php

namespace Modules\Payroll\Entities;

use App\Models\User;
use App\Models\RootModel;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;


class SalaryStructure extends RootModel
{
    use SoftDeletes;

    protected $table = 'salary_structures';

    const TYPE_ADD = "Add";
    const TYPE_OVERTIME = "Overtime";
    const TYPE_DEDUCT = "Deduct";
    const TYPE_PROVIDENT = "Provident";
    const TYPE_INSURANCE = "Insurance";

    protected $fillable = ['id', 'com_id', 'name', 'type', 'status', 'created_by', 'updated_by'];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    function SalaryRuleStructure()
    {
        return $this->hasMany(SalaryRuleStructure::class, 'salary_structure_id', 'id');
    }

}
