<?php

namespace Modules\Employee\Entities;


use App\Models\User;
use App\Models\RootModel;
use App\Common\Imageable;
use App\Common\Addressable;
use App\Common\Documentable;
use App\Common\CascadeSoftDeletes;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Settings\Entities\Shift;
use Illuminate\Notifications\Notifiable;
use Modules\Timesheet\Entities\Attendance;
use Modules\Settings\Entities\EmployeeType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Organization\Entities\Department;
use Modules\Organization\Entities\Designation;
use Modules\Organization\Entities\LeavePolicy;
use Modules\Timesheet\Entities\LeaveApplication;




class Employee extends RootModel
{
    use Documentable, Addressable, Imageable, Notifiable, SoftDeletes, CascadeSoftDeletes;
    //HasDevice

    protected $table = 'employees';

    protected $primaryKey = 'id';

    const TERMINATED = 1;
    const OVERTIME_ALLOW = 1;
    const OVERTIME_NOT_ALLOW = 0;

    protected $cascadeDeletes = ['user'];

    protected $fillable = [
        'id', 'employee_index', 'com_id', 'branch_id', 'department_id', 'designation_id', 'shift_id', 'type_id',
        'provision_period', 'name', 'first_name', 'last_name', 'phone', 'email', 'gender', 'dob', 'marital_status',
        'status', 'joining_date', 'is_terminate', 'termination_date', 'basic_salary', 'created_by', 'updated_by',
        'allow_overtime', 'overtime_allowance', 'allowance_percent', 'leave_policy_id', 'card_no', 'device_id',
    ];

    public static $fetch = [
        'id', 'employee_index', 'com_id', 'branch_id', 'department_id', 'designation_id', 'shift_id', 'type_id',
        'provision_period', 'name', 'first_name', 'last_name', 'phone', 'email', 'gender', 'dob', 'marital_status',
        'status', 'joining_date', 'basic_salary', 'allow_overtime', 'overtime_allowance', 'allowance_percent',
        'leave_policy_id', 'card_no','device_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id', 'id');
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class, 'type_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function educations()
    {
        return $this->hasMany(EmployeeEducation::class, 'employee_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    /**
     *Attendances
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }

    /**
     *Attendances
     */
    public function leaveApplications()
    {
        return $this->hasMany(LeaveApplication::class, 'employee_id', 'id');
    }

    /**
     *Leave Policy
     */
    public function leavePolicy()
    {
        return $this->belongsTo(LeavePolicy::class, 'leave_policy_id', 'id');
    }


}
