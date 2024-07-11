<?php

use \App\Models\Role;
use \App\Models\User;
use \App\Models\Module;
use \Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use \Modules\Company\Entities\Company;
use \Illuminate\Support\Facades\Cache;
use \Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\Tax;
use \Modules\Timesheet\Entities\Attendance;
use \Modules\Timesheet\Entities\LeaveApplication;
use \Illuminate\Notifications\DatabaseNotification;


/**
 * This file only for get list of plucked data;
 */

if (! function_exists('get_companies')) {
    /**
     * get companies or company plucked value only
     */
    function get_companies(int $id = null)
    {
        if (com_id()) {
            return Company::where('id', com_id())->pluck('name', 'id');
        }
        return Cache::rememberForever(app(Company::class)->getTable() . CACHE_COMMON, function () use ($id) {
            return Company::active()->pluck('name', 'id');
        });
    }
}

if (! function_exists('get_single_company')) {
    /**
     * get companies or company plucked value only
     */
    function get_single_company(int $id)
    {
        return Cache::rememberForever(app(Company::class)->getTable() . CACHE_SINGLE . user_id(), function () use ($id) {
            return Company::active()->where('id', com_id())->select('id', 'name', 'phone', 'email')->first();
        });
    }
}


if (! function_exists('get_roles')) {
    /**
     * get roles plucked value only
     */
    function get_roles($level = null)
    {
        if ($level) {
            return Role::active()->commonScope()->where('level', $level)->pluck('name', 'id');
        }
        return Role::mine()->active()->pluck('name', 'id');
    }
}

/**get admin scope modules*/
if (! function_exists('admin_modules')) {
    function admin_modules()
    {
        return Module::active()->where(function ($scope) {
            return $scope->whereJsonContains('scope', [Module::SCOPE_ADMIN])
                ->orWhereJsonContains('scope', [Module::SCOPE_COMMON]);
        })->get();
    }
}

/**get company scope modules*/
if (! function_exists('company_modules')) {
    function company_modules()
    {
        return Module::active()->where(function ($scope) {
            return $scope->whereJsonContains('scope', [Module::SCOPE_COMPANY])
                ->orWhereJsonContains('scope', [Module::SCOPE_COMMON]);
        })->get();
    }
}


/**get employees scope modules*/
if (! function_exists('employee_modules')) {
    function employee_modules()
    {
        return Module::active()->where(function ($scope) {
            return $scope->whereJsonContains('scope', [Module::SCOPE_EMPLOYEE]);
        })->whereHas('submodules', function ($scope) {
            return $scope->whereJsonContains('scope', [Module::SCOPE_EMPLOYEE]);
        })
            ->get();
    }
}

/**get departments*/
if (! function_exists('get_departments')) {
    function get_departments()
    {
        return Cache::rememberForever(app(\Modules\Organization\Entities\Department::class)->getTable() . CACHE_COMMON . com_id(), function () {
            return \Modules\Organization\Entities\Department::commonScope()->active()->pluck('name', 'id');
        });
    }
}

/**get departments*/
if (! function_exists('get_designations')) {
    function get_designations()
    {
        return Cache::rememberForever(app(\Modules\Organization\Entities\Designation::class)->getTable() . CACHE_COMMON . com_id(), function () {
            return \Modules\Organization\Entities\Designation::commonScope()->active()->pluck('name', 'id');
        });

    }
}

/**get get_salary_rule_structure_components*/
if (! function_exists('get_salary_rule_structure_components')) {
    function get_salary_rule_structure_components($type)
    {
        return \Modules\Payroll\Entities\SalaryStructure::commonScope()->active()->where('type', $type)->pluck('name', 'id');
    }
}

/** system settings */
if (! function_exists('system_settings')) {
    function system_settings()
    {
        return Cache::rememberForever(app(\App\Models\SystemSetting::class)->getTable() . CACHE_COMMON, function () {
            return \App\Models\SystemSetting::pluck('value', 'key')->toArray();
            //return \App\Models\SystemSetting::select(\App\Models\SystemSetting::$fetch)->with('logo')->first()->toArray();
        });
    }
}

/** sms gateway */
if (! function_exists('sms_gateway')) {
    function sms_gateway()
    {
        return Cache::rememberForever(app(\App\Models\SmsGateway::class)->getTable() . CACHE_COMMON, function () {
            $data = \App\Models\SmsGateway::active()->select(['id', 'driver', 'details', 'status'])->first();
            if ($data){
                return $data->toArray();
            }
            return ['status' => 0];
        });
    }
}

/** sms gateway */
if (! function_exists('get_single_sms_gateway')) {
    function get_single_sms_gateway($driver)
    {
        return \App\Models\SmsGateway::where('driver', $driver)->select(\App\Models\SmsGateway::$fetch)->first();
    }
}

/** company settings*/
if (! function_exists('company_settings')) {
    function company_settings()
    {
        return Cache::rememberForever(app(\Modules\Company\Entities\CompanySetting::class)->getTable() . CACHE_COMMON . com_id(), function () {
            return \Modules\Company\Entities\CompanySetting::where('com_id', com_id())->pluck('value', 'key')->toArray();
        });
    }
}


/** get_employee_types*/
if (! function_exists('get_employee_types')) {
    function get_employee_types()
    {
        return Cache::rememberForever(app(\Modules\Settings\Entities\EmployeeType::class)->getTable() . CACHE_COMMON . com_id(), function () {
            return \Modules\Settings\Entities\EmployeeType::commonScope()->pluck('name', 'id');
        });
    }
}

/** get_shifts */
if (! function_exists('get_shifts')) {
    function get_shifts()
    {
        return Cache::rememberForever(app(\Modules\Settings\Entities\Shift::class)->getTable() . CACHE_COMMON . com_id(), function () {
            return \Modules\Settings\Entities\Shift::commonScope()->pluck('name', 'id');
        });
    }
}


/** get_timezones*/
if (! function_exists('timezones')) {
    function timezones()
    {
        return Cache::rememberForever(app(\App\Models\Timezone::class)->getTable() . CACHE_COMMON, function () {
            return \DB::table('timezones')->pluck('text', 'id');
        });
    }
}

/** get_timezones*/
if (! function_exists('system_timezone')) {

    function system_timezone()
    {
        return Cache::rememberForever(app(\App\Models\Timezone::class)->getTable() . CACHE_SINGLE, function () {
            if (config('system_settings.timezone_id')) {
                return \DB::table('timezones')->where('id', config('system_settings.timezone_id'))->pluck('utc')->first();
            }
            return Null;
        });
    }
}



/** get_currencies*/
if (! function_exists('currencies')) {
    function currencies($all = false)
    {
        return Cache::rememberForever(app(\App\Models\Currency::class)->getTable() . CACHE_COMMON, function () use ($all) {
            $query = \DB::table('currencies')->select('name', 'symbol', 'iso_code', 'id');

            if (! $all) {
                $query->where('active', 1);
            }

            $currencies = $query->orderBy('priority', 'asc')->orderBy('name', 'asc')->get();

            $result = [];
            foreach ($currencies as $currency) {
                $result[$currency->id] = $currency->name . ' (' . $currency->iso_code . ' ' . $currency->symbol . ')';
            }

            return $result;
        });
    }
}

/**get total employee count*/
if (! function_exists('get_count_employee')) {
    function get_count_employee()
    {
        return Cache::rememberForever(app(Employee::class)->getTable() . CACHE_DASHBOARD . user_id(), function () {
            return Employee::active()->mine()->count();
        });
    }
}


/**get total user count*/
if (! function_exists('get_count_users')) {
    function get_count_users()
    {
        return Cache::rememberForever(app(User::class)->getTable() . CACHE_DASHBOARD . user_id(), function () {
            return User::active()->where('level', User::USER_ADMIN)->count();
        });
    }
}

/**get total employee on leave*/
if (! function_exists('get_count_employee_leave')) {
    function get_count_employee_leave()
    {
        return Cache::rememberForever(app(LeaveApplication::class)->getTable() . CACHE_DASHBOARD . user_id(), function () {
            return LeaveApplication::mine()
                ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)
                ->where('start_date', '>', Carbon::now()->subDay())
                ->where('end_date', '<', Carbon::now()->addDay())
                ->count();
        });
    }
}


/**get total employee present count*/
if (! function_exists('get_count_employee_present')) {
    function get_count_employee_present()
    {
        return Cache::rememberForever(app(Attendance::class)->getTable() . CACHE_DASHBOARD . user_id(), function () {
            return Attendance::mine()
                ->whereBetween('attendance_date', [Carbon::now()->subDay(), Carbon::now()->addDay()])
                ->count();
        });
    }
}

/**get total notifications count*/
if (! function_exists('get_count_notification')) {
    function get_count_notification()
    {
        return DatabaseNotification::whereHas('notifiable', function ($user) {
            $user->where('id', user_id());
        })
            ->whereNull('read_at')->count();
    }
}

/**get notifications*/
if (! function_exists('get_notifications')) {
    function get_notifications()
    {
        return DatabaseNotification::with('notifiable:id,name')
            ->whereHas('notifiable', function ($user) {
                $user->where('id', user_id());
            })
            ->select('id', 'read_at', 'data', 'notifiable_type', 'notifiable_id', 'created_at')
            ->whereNull('read_at')
            ->limit(config('system.notification_limit'))
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

/**get notifiable admin*/
if (! function_exists('set_notifiable_admin')) {
    function set_notifiable_admin()
    {
        if (is_admin()) {
            return null;
        }

        if (is_company_admin()) {
            //return admin info
            return Cache::rememberForever(app(User::class)->getTable() . CACHE_SINGLE . user_id(), function () {
                return User::where('level', User::USER_ADMIN_ADMIN)->whereNull('com_id')->first();
            });
        }

    }
}


/**get notifications */
/*if (! function_exists('get_notifications')) {
    function get_notifications()
    {
        return DatabaseNotification::with('notifiable:id,name')
            ->whereHas('notifiable', function ($user) {
                $user->where('id', user_id());
            })
            ->select('id', 'read_at', 'data', 'notifiable_type', 'notifiable_id', 'created_at')
            ->whereNull('read_at')->limit(6)->get();
    }
}*/

/**Leave types */
if (! function_exists('get_leave_types')) {
    function get_leave_types()
    {
        return Cache::rememberForever(app(\Modules\Settings\Entities\LeaveType::class)->getTable() . CACHE_COMMON . com_id(), function () {
            return \Modules\Settings\Entities\LeaveType::commonScope()->active()->select('id', DB::raw('CONCAT(name," : ",days) as name'))->pluck('name', 'id');
        });
    }
}

/**leave policies  */
if (! function_exists('get_leave_policies')) {
    function get_leave_policies()
    {
        return Cache::rememberForever(app(\Modules\Organization\Entities\LeavePolicy::class)->getTable() . CACHE_COMMON . com_id(), function () {
            return \Modules\Organization\Entities\LeavePolicy::commonScope()->active()->pluck('name', 'id');
        });
    }
}

/*get Employee Available Leave Days*/
if (! function_exists('get_employee_leaveTypes')) {
    function get_employee_leaveTypes()
    {
        $data = [];
        $employee = Employee::with('leavePolicy:id,type_id')
            ->select('id', 'leave_policy_id')
            ->where('id', auth()->user()->employee_id)
            ->first();

        if ($employee->leavePolicy){
            foreach ($employee->leavePolicy->type_id as $type) {

                array_push($data, ['id' => $type->id, 'name' => $type->name
                    . ' || Available Days : ' . ($type->days - $type->leaveApplications()->groupBy('employee_id')
                            ->where('approval_status', LeaveApplication::APPROVAL_STATUS_APPROVED)->sum('leave_days'))]);
            }
        }

        return json_encode($data);
    }
}

/**get get_salary_rule_structure_components by id*/
if (! function_exists('get_salary_rule_structure_component_by_id')) {
    function get_salary_rule_structure_component_by_id($ruleId, $structureId)
    {
        return \Modules\Payroll\Entities\SalaryRuleStructure::where('salary_rule_id', $ruleId)->where('salary_structure_id', $structureId)->first();
    }
}

/**get get_salary_rule_structure_components by id*/
if (! function_exists('get_created_by')) {
    function get_created_by($id)
    {
        return (User::where('id', $id)->pluck('name'))[0] ?? null;
    }
}


/**get get_salary_rule_structure_components by id*/
if (! function_exists('get_holiday_sum_by_month')) {
    function get_holiday_sum_by_month($month)
    {
        return \Modules\Settings\Entities\Holiday::where('com_id', request()->get('com_id') ?? com_id())
            ->where('holiday_year', Carbon::parse($month)->format('Y'))
            ->where('holiday_month', Carbon::parse($month)->format('m'))
            ->sum('days');
    }
}


/**get get_salary_rule_structure_components by id*/
if (! function_exists('get_job_categories')) {
    function get_job_categories()
    {
        return \Modules\Settings\Entities\BlogCategory::active()->with('jobs:id,category_id,position')->get();
    }
}

/**get get_salary_rule_structure_components by id*/
if (! function_exists('get_config_value')) {
    function get_config_value($key)
    {
        return (DB::table('system_settings')->select('value')->where('key', $key)->first())?->value;
    }
}


/**get employee unique ID*/
if (! function_exists('make_employee_unique_id')) {
    function make_employee_unique_id(): string
    {
        $index = DB::table('employees')->select('employee_index');
            //$index = (com_id() ? $index->where('com_id', com_id()) : $index);
            $index = $index->orderBy('id', 'desc')->first();
        $offset = (strlen(config('system_settings.employee_id_prefix')) !== 0
            ? strlen(config('system_settings.employee_id_prefix'))
            : 3);

        if (preg_match( "/^[^a-zA-Z]+$/", $index->employee_index)){
            $total = (int)$index->employee_index;
        }
        else
        {
            $total =(int)(! empty($index) ? (substr($index->employee_index, $offset)) : 0);
        }

        $length = (config('system_settings.employee_id_length') - strlen(config('system_settings.employee_id_prefix')));
        $total = $total + 2;
        $int = sprintf("%0" . $length . "d", $total);



        return config('system_settings.employee_id_prefix') . $int;
    }
}

/**get employee unique ID*/
if (! function_exists('tax_calculation')) {
    function tax_calculation($salary)
    {
        if (! com_id()){
            return "You have to login from under company access level!";
        }
        $taxes = Tax::active()->select('eligible_amount', 'tax')->where('com_id', com_id())->orderBy('eligible_amount', 'desc')->get();

        foreach ($taxes as $tax) {
            if ($tax->eligible_amount <= $salary)
            {
                return ($tax->tax / 100) * $salary;
            }
        }
    }
}

/**get employee unique ID*/
if (! function_exists('get_penalty')) {
    function get_penalty($month, $empId = null)
    {
        if ($empId)
        {
            return \Modules\Employee\Entities\Penalty::where('employee_id', $empId)->where('month', $month)->get();
        }
        return \Modules\Employee\Entities\Penalty::where('month', $month)->get();
    }
}















