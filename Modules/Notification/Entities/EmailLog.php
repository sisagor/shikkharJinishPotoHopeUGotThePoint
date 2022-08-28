<?php

namespace Modules\Notification\Entities;

use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;


class EmailLog extends RootModel
{

    protected $table = 'email_log';

    const SENT = 1;
    const FAILED = 0;


    protected $fillable = [
        'id', 'com_id', 'branch_id', 'employee_id', 'email', 'subject', 'body'
    ];

    public static $fecth = [
        'id', 'email', 'subject', 'body', 'status', 'created_at',
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
