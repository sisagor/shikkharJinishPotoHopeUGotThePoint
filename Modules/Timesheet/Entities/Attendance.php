<?php

namespace Modules\Timesheet\Entities;

use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Attendance extends RootModel
{

    protected $table = 'attendances';

    const CECkHIN = "checkin";
    const CHECKOUT = "checkout";
    const NOT_DONE = null;

    protected $fillable = [
        'id', 'com_id', 'branch_id', 'employee_id', 'device_ip',
        'checkin_time', 'checkout_time', 'attendance_date',
        'working_hour', 'overtime', 'late', 'status'
    ];

    public static $fetch = [
        'id', 'employee_id',  'device_ip',
        'checkin_time', 'checkout_time', 'attendance_date', 'working_hour', 'late', 'overtime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

}
