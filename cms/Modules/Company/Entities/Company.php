<?php

namespace Modules\Company\Entities;

use App\Models\User;
use App\Models\RootModel;
use App\Common\Imageable;
use App\Common\CascadeSoftDeletes;
use App\Models\ZktDevice;
use Modules\Branch\Entities\Branch;
use Modules\Settings\Entities\Holiday;
use Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\LeaveType;
use Modules\Organization\Entities\Department;
use Illuminate\Database\Eloquent\SoftDeletes;



class Company extends RootModel
{
    //use imageable
    use Imageable, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'companies';

    protected $cascadeDeletes = ['user'];

    protected $fillable = ['id', 'name', 'phone', 'email', 'details', 'address', 'status'];

    public static $fetch = ['id', 'name', 'phone', 'email', 'details', 'address', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasMany(ZktDevice::class, 'com_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'com_id', 'id');
    }

    /**
     *return role
     */
    public function department()
    {
        return $this->hasMany(Department::class, 'com_id', 'id');
    }


    public function employees()
    {
        return $this->hasMany(Employee::class, 'employee_id', 'id');
    }

    /**settings*/
    public function settings()
    {
        return $this->hasOne(CompanySetting::class, 'com_id', 'id');
    }

    /**Leave types*/
    public function leaveTypes()
    {
        return $this->hasMany(LeaveType::class, 'com_id', 'id');
    }

    /**Leave types*/
    public function holidays()
    {
        return $this->hasMany(Holiday::class, 'com_id', 'id');
    }

}
