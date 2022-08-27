<?php

namespace Modules\Notification\Entities;

use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;


class ScheduleEmailSms extends RootModel
{
    //use SoftDeletes;

    protected $table = 'schedule_email_sms';

    const TYPE_EMAIL = "email";
    const TYPE_SMS = "sms";


    protected $fillable = [
        'id', 'com_id', 'branch_id', 'delivery_type', 'delivery_time', 'type', 'details'
    ];

    public static $fecth = [
        'id', 'com_id', 'branch_id', 'delivery_type', 'delivery_time', 'type', 'details'
    ];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

}
