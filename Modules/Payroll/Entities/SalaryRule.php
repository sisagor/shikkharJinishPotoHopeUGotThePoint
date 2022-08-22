<?php

namespace Modules\Payroll\Entities;

use App\Models\User;
use App\Models\RootModel;
use Modules\Company\Entities\Company;
use Modules\Organization\Entities\Designation;
use Illuminate\Database\Eloquent\SoftDeletes;


class SalaryRule extends RootModel {

    use SoftDeletes;

    protected $table = 'salary_rules';

    protected $fillable = ['id', 'com_id', 'designation_id', 'name','details', 'basic_salary', 'status', 'created_by', 'updated_by', 'deleted_at'];

    function company(){
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    function designation(){
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    function salaryRuleStructure(){
        return $this->hasMany(SalaryRuleStructure::class, 'salary_rule_id', 'id');
    }


}
