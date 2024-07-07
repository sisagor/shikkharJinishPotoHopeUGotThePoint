<?php

namespace Modules\Timesheet\Entities;

use App\Common\Documentable;
use App\Common\Imageable;
use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\LeaveType;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;


class LeaveApplication extends RootModel
{
    use Documentable;

    const TYPE_DAYS = "days";
    const TYPE_HOUR = "hour";

    protected $table = 'leave_applications';

    protected $fillable = [
        'id', 'com_id', 'type_id', 'branch_id', 'employee_id', 'start_date', 'end_date', 'dates', 'details', 'leave_days',
        'leave_for', 'leave_hour_date', 'leave_hour', 'approval_status', 'approved_by', 'created_by',
    ];


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class, 'type_id', 'id');
    }

}
