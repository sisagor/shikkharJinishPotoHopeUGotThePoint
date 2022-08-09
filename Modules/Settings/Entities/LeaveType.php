<?php

namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;
use Modules\Organization\Entities\LeavePolicy;
use Modules\Timesheet\Entities\LeaveApplication;

class LeaveType extends RootModel
{
    use SoftDeletes;

    protected $table = 'leave_types';

    const PAID_LEAVE = "Paid";
    const UNPAID_LEAVE = "Unpaid";

    protected $fillable = [
        'id', 'com_id', 'type', 'name', 'days', 'details', 'status', 'created_by'
    ];

    public static $fetch = [
        'id', 'com_id', 'name', 'days', 'details', 'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function policy()
    {
        return $this->hasMany(LeavePolicy::class, 'type_id', 'id');
    }

    public function leaveApplications()
    {
        return $this->hasMany(LeaveApplication::class, 'type_id', 'id');
    }

    public function getAvailableDays()
    {
        return $this->leaveApplications()->whereRaw('approval_status',
            LeaveApplication::APPROVAL_STATUS_APPROVED)->selectRaw('type_id, SUM(' . $this->days . ' - leave_days) as leaveDays')->groupByRaw('type_id');
    }
}

