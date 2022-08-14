<?php

namespace Modules\Notification\Entities;

use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;


class SmsLog extends RootModel
{

    use SoftDeletes;

    protected $table = 'sms_log';

    const SENT = 1;
    const FAILED = 0;


    protected $fillable = [
        'id', 'com_id', 'branch_id', 'employee_id', 'sms'
    ];

    public static $fecth = [
        'id', 'com_id', 'branch_id', 'employee_id', 'sms'
    ];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }


}
