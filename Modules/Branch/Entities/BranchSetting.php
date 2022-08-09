<?php

namespace Modules\Branch\Entities;

use App\Models\RootModel;

class BranchSetting extends RootModel {


    const ATTENDANCE_IP = "ip_based";
    const ATTENDANCE_MANUAL = "manual";

    protected $table = 'branch_settings';


    protected $fillable = ['id', 'com_id', 'branch_id', 'allow_employee_login', 'device_ip', 'attendance', 'allow_overtime', 'enable_device'];

    public static $fetch = ['id', 'com_id', 'branch_id', 'allow_employee_login', 'device_ip', 'attendance', 'allow_overtime', 'enable_device'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**
     * @return Branch active or not
     */
    function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }


}
