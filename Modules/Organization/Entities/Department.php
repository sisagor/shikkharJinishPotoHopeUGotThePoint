<?php

namespace Modules\Organization\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;
use App\Models\User;
use Modules\Employee\Entities\Employee;

class Department extends RootModel {

    use SoftDeletes;

    protected $table = 'departments';

    protected $fillable = ['id', 'com_id', 'name','details', 'status', 'created_by', 'updated_by'];

    public function company(){
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function employee(){
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }


}
