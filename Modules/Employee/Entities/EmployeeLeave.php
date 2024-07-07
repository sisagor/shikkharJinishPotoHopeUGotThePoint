<?php

namespace Modules\Employee\Entities;

use App\Models\User;
use App\Models\RootModel;
use Modules\Settings\Entities\LeaveType;


class EmployeeLeave extends RootModel
{

    protected $table = 'employee_leaves';

    protected $fillable = [
        'id', 'employee_id', 'type_id', 'leave_days', 'taken_days', 'available_days', 'created_by'
    ];

    public static $fetch = [
        'id', 'employee_id', 'type_id', 'leave_days', 'taken_days', 'available_days', 'created_by'
    ];

    function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'type_id', 'id');
    }


}