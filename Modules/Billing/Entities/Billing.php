<?php

namespace Modules\Billing\Entities;

use App\Models\User;
use App\Models\RootModel;
use App\Common\Documentable;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;



class Billing extends RootModel {

    use Documentable, SoftDeletes;
    //
    protected $table = 'billings';

    const BILLING_STATUS_PENDING = 0;
    const BILLING_STATUS_APPROVE_MANAGER = 1;
    const BILLING_STATUS_APPROVE_ADMIN = 2;
    const BILLING_STATUS_REJECTED = 3;


    protected $fillable = [
        'id', 'com_id', 'branch_id', 'manager_id', 'project_id', 'office_id', 'site_id', 'total',
        'title', 'mobile_bill', 'allowance', 'allowance_history', 'other_bill', 'other_bill_history',
        'approve_one','approve_two', 'approve_one_date', 'approve_two_date', 'created_by', 'status'
    ];

    public static $fetch = [
        'id', 'com_id', 'branch_id', 'manager_id', 'project_id', 'office_id', 'site_id', 'total',
        'title', 'mobile_bill', 'allowance', 'allowance_history', 'other_bill', 'other_bill_history',
        'approve_one','approve_two', 'approve_one_date', 'approve_two_date', 'created_by', 'status'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }


}
