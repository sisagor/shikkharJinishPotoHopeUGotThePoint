<?php

namespace Modules\Organization\Entities;

use App\Models\User;
use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Modules\Payroll\Entities\SalaryRule;


class Designation extends RootModel {

    use SoftDeletes;

    protected $table = 'designations';

    protected $fillable = ['id', 'com_id', 'name', 'details', 'status', 'created_by', 'updated_by'];


    public function company(){
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_at', 'id');
    }

    public function salaryRule(){
        return $this->hasOne(SalaryRule::class, 'designation_id', 'id');
    }

    public function employee(){
        return $this->hasMany(Employee::class, 'designation_id', 'id');
    }


}
