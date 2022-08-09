<?php

namespace Modules\Branch\Entities;

use App\Common\CascadeSoftDeletes;
use App\Models\Role;
use App\Models\User;
use App\Common\Imageable;
use App\Models\RootModel;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;



class Branch extends RootModel
{
    use Imageable, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'branches';

    protected $cascadeDeletes = ['user'];

    protected $fillable = ['id', 'com_id', 'name', 'email', 'phone', 'city', 'address', 'status'];

    public static $fetch = ['id', 'com_id', 'name', 'email', 'phone', 'address', 'status'];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function user()
    {
        return $this->hasOne(User::class);
    }

    function employees()
    {
        return $this->hasMany(Employee::class, 'employee_id', 'id');
    }

    /*Settings*/
    public function settings()
    {
        return $this->hasOne(BranchSetting::class, 'branch_id', 'id');

    }

}
