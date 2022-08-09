<?php

namespace Modules\Timesheet\Entities;

use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Absent extends RootModel
{

    protected $table = 'absent_log';



    protected $fillable = [
        'id', 'com_id', 'branch_id', 'employee_id', 'absent_date'
    ];

    public static $fetch = [
        'id', 'com_id', 'branch_id', 'employee_id', 'absent_date'
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
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

}
