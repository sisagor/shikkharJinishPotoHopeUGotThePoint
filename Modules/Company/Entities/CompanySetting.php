<?php

namespace Modules\Company\Entities;

use App\Models\RootModel;

class CompanySetting extends RootModel
{

    const ATTENDANCE_IP = "ip_based";
    const ATTENDANCE_MANUAL = "manual";


    protected $table = 'company_settings';

    protected $fillable = [
        'com_id', 'employee_id_prefix', 'employee_id_length', 'has_provision_period', 'allow_overtime', 'device_ip',
        'attendance', 'has_attendance_deduction_policy', 'allow_employee_login', 'has_allowances', 'allow_holiday_work_as_overtime',
        'enable_device', 'allow_bulk_upload', 'default_password', 'has_tax_policy', 'provision_period', 'has_increment', 'increment_year',
        'has_efficient_bar', 'efficient_bar_year', 'has_provident_fund', 'employee_pf', 'company_pf', 'has_welfare_fund', 'welfare_fund_amount',
        'has_gratuity', 'gratuity_apply_after'
    ];

    public static $fetch = [
        'com_id', 'employee_id_prefix', 'employee_id_length', 'has_provision_period', 'allow_overtime', 'device_ip',
        'attendance', 'has_attendance_deduction_policy', 'allow_employee_login', 'has_allowances', 'allow_holiday_work_as_overtime',
        'enable_device', 'allow_bulk_upload', 'default_password', 'has_tax_policy', 'provision_period', 'has_increment', 'increment_year',
        'has_efficient_bar', 'efficient_bar_year', 'has_provident_fund', 'employee_pf', 'company_pf', 'has_welfare_fund', 'welfare_fund_amount',
        'has_gratuity', 'gratuity_apply_after'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**
     * @return company active or not
     */
    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }


}
