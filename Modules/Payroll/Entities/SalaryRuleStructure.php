<?php

namespace Modules\Payroll\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryRuleStructure extends RootModel {

    //use SoftDeletes;

    protected $table = 'salary_rule_structures';

    public $timestamps = false;

    protected $fillable = ['id', 'salary_rule_id', 'salary_structure_id', 'amount', 'is_percent'];

    function salaryRule(){
        return $this->belongsTo(SalaryRule::class, 'salary_rule_id', 'id');
    }

    function salaryStructure(){
        return $this->belongsTo(SalaryStructure::class, 'salary_structure_id', 'id');
    }

}
