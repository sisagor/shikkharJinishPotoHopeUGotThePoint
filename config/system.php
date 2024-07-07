<?php
/*
|--------------------------------------------------------------------------
| System configs
|--------------------------------------------------------------------------
|
| The application needs this config file to run properly.
| Don't change any value is you're not sure about it.
|
*/
return [

    'database' => env('DB_DATABASE'),

    /*
    |--------------------------------------------------------------------------
    | Use Cache
    |--------------------------------------------------------------------------
    |
    | Config values for cache.
    | if yes you need to config cache credentials
    */
    'use_cache' => env('USE_CACHE', false),


    /*
    |--------------------------------------------------------------------------
    | CSV Import Limit
    |--------------------------------------------------------------------------
    |
    | This much records can be uploaded in a single batch in csv upload inventories/products
    |
    */
    'csv_import_limit' => 50,

    /*
    |--------------------------------------------------------------------------
    | Import Required
    |--------------------------------------------------------------------------
    |
    | This fields are required to csv upload
    |
    */
    'import_required' => [],

    /*
    |--------------------------------------------------------------------------
    | Notification limit
    |--------------------------------------------------------------------------
    |
    */

    'notification_limit' => 10,


    'settings' => [
        'general' => [
            'system_name' => "Inta-Hrm",
            'system_phone' => "01826319556",
            'system_email' => "intadev@gmail.com",
            'pagination' => "20",
            'report_pagination' => "100",
            'currency_id' => 5,
            'timezone_id' => 5,
            'show_currency_symbol' => 1,
            'show_space_after_symbol' => null,
            'mix' => null,
            'phone_country_code' => "+880",
            'logo' => null,
            'login_image' => null,
            'allow_bulk_upload' => null,
            'default_password' => "123456",
            'employee_id_prefix' => "ITD",
            'employee_id_length' => 6,
            'allow_employee_login' => 1,
        ],

        'wallet' => [
            'has_welfare_fund' => null,
            'welfare_fund_amount' => null,
            'has_provident_fund' => null,
            'employee_pf' => null,
            'company_pf' => null,
            'has_gratuity' => null,
            'gratuity_apply_after' => null,
        ],

        'payroll' => [
            'has_provision_period' => 1,
            'provision_period' => 12,
            'allow_overtime' => 1,
            'has_attendance_deduction_policy' => 1,
            'allow_holiday_work_as_overtime' => null,
            'has_tax_policy' => 1,
            'has_increment' => null,
            'increment_year' => null,
            'has_efficient_bar' => null,
            'efficient_bar_year' => null,
            'has_allowances' => null,
        ],

        'notification' => [
            'store_email_log' => null,
            'store_sms_log' => null,
            'system_realtime_notification' => 1,
            'email_notification' => null,
            'sms_notification' => null,
        ],
    ]

];
