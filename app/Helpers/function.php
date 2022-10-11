<?php
/// Auth::user() related all functions

use App\Models\User;
use App\Models\RootModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Modules\Branch\Entities\BranchSetting;
use Modules\Company\Entities\CompanySetting;


if (! function_exists('com_id')) {
    /** return company id*/
    function com_id()
    {
        return Auth::user()->com_id ?? null;
    }
}

if (! function_exists('is_super_admin')) {
    /** return company id*/
    function is_super_admin()
    {
        return (Auth::user()) ? Auth::user()->isSuperAdmin() : null;
    }
}

if (! function_exists('is_department_admin')) {
    /** return company id*/
    function is_department_admin()
    {
        return (Auth::user() && Auth::user()->level == User::USER_ADMIN && Auth::user()->department_id)
            ? Auth::user()->department_id
            : null;
    }
}

if (! function_exists('is_admin_group')) {
    /** return company id*/
    function is_admin_group()
    {
        return Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isAdminUser();
    }
}

if (! function_exists('is_admin_user')) {
    /** return admin usee id*/
    function is_admin_user()
    {
        return Auth::user()->isAdminUser();
    }
}

if (! function_exists('is_admin')) {
    /** return company id*/
    function is_admin()
    {
        return Auth::user()->isAdmin();
    }
}


if (! function_exists('is_company_admin')) {
    /** return company id*/
    function is_company_admin()
    {
        return Auth::user()->com_id && Auth::user()->level == User::USER_COMPANY_ADMIN;
    }
}

if (! function_exists('is_company_group')) {
    /** return company id*/
    function is_company_group()
    {
        return (Auth::user()->com_id && (Auth::user()->level == User::USER_COMPANY_ADMIN || User::USER_ADMIN) && ! Auth::user()->branch_id);
    }
}

if (! function_exists('is_branch_admin')) {
    /** return company id*/
    function is_branch_admin(): bool
    {
        return Auth::user()->branch_id && Auth::user()->level == User::USER_BRANCH_ADMIN;
    }
}

if (! function_exists('is_branch_group')) {
    /** return company id*/
    function is_branch_group(): bool
    {
        return Auth::user()->branch_id && (Auth::user()->level == User::USER_BRANCH_ADMIN || User::USER_ADMIN);
    }
}


if (! function_exists('is_employee')) {
    /** return employee admin tru or id*/
    function is_employee(): int
    {
        return Auth::user()->employee_id ?? 0;
    }
}

if (! function_exists('is_employee_admin')) {
    /** return employee admin tru or id*/
    function is_employee_admin(): bool
    {
        return Auth::user()->employee_id && Auth::user()->level == User::USER_ADMIN;
    }
}

if (! function_exists('is_employee_user')) {
    /** return employee admin tru or id*/
    function is_employee_user(): bool
    {
        return Auth::user()->employee_id && Auth::user()->level == User::USER_EMPLOYEE;
    }
}

if (! function_exists('branch_id')) {
    /** return branch_id */
    function branch_id()
    {
        return Auth::user()->branch_id ?? null;
    }
}


if (! function_exists('user_id')) {
    /** return Auth::user()_id */
    function user_id()
    {
        return Auth::user()->id;
    }
}

if (! function_exists('role_id')) {
    /** return role_id */
    function role_id()
    {
        return Auth::user()->role_id;
    }
}


if (! function_exists('get_status')) {
    /** return status*/
    function get_status($status): ?string
    {
        switch ($status) {
            case RootModel::STATUS_ACTIVE :
                return 'Active';
                break;
            case RootModel::STATUS_INACTIVE :
                return 'Inactive';
                break;

            default :
                return null;
        }
    }
}

if (! function_exists('get_approval_status')) {
    /** return status*/
    function get_approval_status($approve): ?string
    {
        switch ($approve) {
            case RootModel::APPROVAL_STATUS_PENDING :
                return 'Pending';
                break;
            case RootModel::APPROVAL_STATUS_APPROVED :
                return 'Approved';
                break;
            case RootModel::APPROVAL_STATUS_REJECTED :
                return 'Rejected';
                break;
            default :
                return 'Pending';
                break;
        }
    }
}

if (! function_exists('get_role_level')) {
    /** return status*/
    function get_role_level($level)
    {
        switch ($level) {
            case App\Models\Role::ROLE_ADMIN :
                return 'Admin';
                break;
            case App\Models\Role::ROLE_COMPANY :
                return 'Company';
                break;
            case App\Models\Role::ROLE_BRANCH :
                return 'Branch';
                break;
            case App\Models\Role::ROLE_ADMIN_USER :
                return 'Admin User';
                break;
            case App\Models\Role::ROLE_EMPLOYEE :
                return 'Employee';
                break;

            default :
                return null;
        }
    }
}

if (! function_exists('my_encode')) {
    function my_encode($value)
    {
        $tp = '10000' . $value;
        return base64_encode($tp);
    }
}

if (! function_exists('my_decode')) {
    function my_decode($value)
    {
        $tp = base64_decode($value);
        return substr($tp, 5, 50);
    }
}

if (! function_exists('set_action')) {
    function set_action($action, $id = null)
    {
        session(['action' => $action]);
        if ($id) {
            session(['actionId' => $id]);
        }
    }
}

if (! function_exists('set_action_title')) {
    function set_action_title($title)
    {
        session(['actionTitle' => $title]);
    }
}

if (! function_exists('set_action_button')) {
    function set_action_button($name)
    {
        session(['actionBtn' => $name]);
    }
}

if (! function_exists('get_approved_by')) {
    function get_approved_by($id)
    {
        return (User::where('id', $id)->first())->name ?? null;
    }
}

if (! function_exists('get_exception_message')) {
    /**
     * @returnStringExceptionMessage
     */
    function get_exception_message($exception)
    {
        return $exception->getMessage() . ' | Line: ' . $exception->getLine() . ' | File: ' . $exception->getFile();
    }
}

if (! function_exists('get_profile_url')) {
    /**
     * return profile url
     */
    function get_profile_url()
    {
        if (is_employee()) {
            return \Illuminate\Support\Facades\Cache::rememberForever('employees' . CACHE_USER . user_id(), function () {
                return route('employee.employee.view', Auth::user()->employee_id);
            });
        }
        if (is_branch_admin()) {
            return \Illuminate\Support\Facades\Cache::rememberForever('branches' . CACHE_USER . user_id(), function () {
                return route('branch.branch.profile', Auth::user()->branch);
            });
        }
        if (is_company_admin()) {
            return \Illuminate\Support\Facades\Cache::rememberForever('companies' . CACHE_USER . user_id(), function () {
                return route('company.company.profile', Auth::user()->company);
            });

        }
        return \Illuminate\Support\Facades\Cache::rememberForever('profiles' . CACHE_USER . user_id(), function () {
            return route('userManagements.user.profile', Auth::user()->profile);
        });
    }
}

if (! function_exists('get_profile_picture_url')) {
    /**
     * get profile picture url
     */
    function get_profile_picture_url()
    {
        if (is_employee()) {
            return \Illuminate\Support\Facades\Cache::rememberForever('images_single_' . Auth::id(), function () {
                return optional(Auth::user()->employee->profile)->path;
            });
        }
        if (is_branch_admin()) {
            return \Illuminate\Support\Facades\Cache::rememberForever('images_single_' . Auth::id(), function () {
                return optional(Auth::user()->branch->profile)->path;
            });
        }
        if (is_company_admin()) {
            return \Illuminate\Support\Facades\Cache::rememberForever('images_single_' . Auth::id(), function () {
                return optional(Auth::user()->company->profile)->path;
            });
        }

        return \Illuminate\Support\Facades\Cache::rememberForever('images_single_' . Auth::id(), function () {
            return optional(Auth::user()->profile->profile)->path;
        });
    }
}


if (! function_exists('get_percentage_sign')) {
    /**
     * get_percentage sing
     * @param int $label
     * @return str
     */
    function get_percentage_sign(int $percentage)
    {
        return $percentage . ' %';
    }
}

/**get Total date count of table*/
if (! function_exists('get_total_count')) {
    function get_total_count($table, $request = null)
    {
        $query = \Illuminate\Support\Facades\DB::table($table);
        //$data = scope_query_builder($query, $request);
        return $query->count();
    }
}


/**get Total date count of table*/
if (! function_exists('common_search')) {
    function common_search($query, $request = null)
    {
       /* if (is_company_admin() && ! $request->filled('branch_id')){
            $query->whereNull('branch_id');
        }*/
        if ($request->filled('com_id')) {
            return $query->where('com_id', $request->get('com_id'));
        }
        if ($request->filled('branch_id')) {
            return $query->where('branch_id', $request->get('branch_id'));
        }

        return $query;
    }
}


if (! function_exists('get_setting_url')) {
    /**
     * get_payment_status_name
     * @param int $label
     * @return str
     */
    function get_setting_url()
    {
        if (branch_id()) {
            return route('branch.branch.settings');
        }
        if (com_id()) {
            return route('company.company.settings');
        }

        return route('settings');
    }
}


if (! function_exists('get_menu_url')) {
    /** return menu url*/
    function get_menu_url()
    {
        $request = request()->segments();
        //unset($request[0]);
        $url = null;

        foreach ($request as $item) {
            if (is_numeric($item)) {
                continue;
            }
            $url .= $item . '/';
        }

        $url = rtrim($url, '/');

        if (empty($url)) {
            return request()->segment(1);
        }

        $menuUrl  = preg_replace('/\bupdate\b/u', 'edit', $url);
        $menuUrl  = preg_replace('/\bstore\b/u', 'add', $menuUrl);

        return ($menuUrl);
    }
}


if (! function_exists('get_module_url')) {
    /** return module url*/
    function get_module_url()
    {
        return request()->segment(1) ?? null;
    }
}


if (! function_exists('has_permission')) {
    /**add new button*/
    function has_permission($action): bool
    {
        if (! \App\Common\HasPermission::hasPermission($action)) {
            return false;
        }
        return true;
    }
}

if (! function_exists('has_permission_url')) {
    /**add new button*/
    function has_permission_url($url): bool
    {
        if (!  \App\Common\HasPermission::hasPermissionUrl($url)) {
            return false;
        }
        return true;
    }
}

if (! function_exists('salary_paid_status')) {
    /**add new button*/
    function salary_paid_status($status)
    {
        switch ($status) {
            case \Modules\Payroll\Entities\Salary::IS_PAID :
                return '<span class="text-success">Paid</span>';
                break;
            case \Modules\Payroll\Entities\Salary::IS_PARTIAL_PAID :
                return '<span class="text-info">Partially Paid</span>';
                break;
            default :
                return '<span class="text-warning">Unpaid</span>';
                break;
        }
    }
}

if (! function_exists('get_formatted_number')) {
    /**add new button*/
    function get_formatted_number($value, $place)
    {
        return sprintf('%.' . $place . 'f', round($value, $place));
    }
}

if (! function_exists('get_months_of_the_year')) {
    /**add new button*/
    function get_months_of_the_year($year = null)
    {
        if ($year) {
            return \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()
                ->year($year)->startOfYear(), '1 month', \Carbon\Carbon::now()
                ->year($year)->endOfYear());
        }

        return \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfYear(), '1 month', \Carbon\Carbon::now()->endOfYear());
    }
}


if (! function_exists('convert_time_to_second')) {
    /**add new button*/
    function convert_time_to_second($time)
    {
        if (\Illuminate\Support\Str::contains($time, '.')){
            $d = explode('.', $time);
            return ($d[0] * 3600) + ($d[1] * 60);
        }
        $d = explode(':', $time);
        $seconds = (! empty($d[2]) ? $d[2] : 0);
        return ($d[0] * 3600) + ($d[1] * 60) + $seconds;
    }
}


if (! function_exists('get_device_ip')) {
    /**add new button*/
    function get_device_ip()
    {
        return is_company_admin() ? config('company_settings.device_ip') : config('branch_settings.device_ip');
    }
}


if (! function_exists('check_device_active')) {
    /**add new button*/
    function check_device_active($type)
    {
        if ($type == "company") {
            if
            (
                config('company_settings.enable_device')
                && config('company_settings.attendance') == CompanySetting::ATTENDANCE_IP
                && config('company_settings.device_ip')
            ) {
                return true;
            }
            return false;
        }
        if ($type == "branch") {
            if
            (
                config('branch_settings.enable_device')
                && config('branch_settings.attendance') == BranchSetting::ATTENDANCE_IP
                && config('branch_settings.device_ip')
            ) {
                return true;
            }
            return false;
        }

        return false;
    }
}



if (!function_exists('get_platform_title')) {
    /**
     * Return shop title or the application title
     */
    function get_platform_title()
    {
        return config('system_settings.system_name') ?: config('app.name');
    }
}

if (!function_exists('get_org_title')) {
    /**
     * Return shop title or the application title
     */
    function get_org_title()
    {
        return config('branch_settings.branch.name') ?: config('company_settings.company.name');
    }
}


if (!function_exists('get_system_currency')) {
    function get_system_currency()
    {
        return config('system_settings.currency.iso_code');
    }
}


if (!function_exists('get_currency_symbol')) {
    function get_currency_symbol()
    {
        return config('system_settings.currency.symbol', '$');
    }
}

if (!function_exists('get_option_table_name')) {
    function get_option_table_name()
    {
        return 'options';
    }
}


if (!function_exists('get_csv_import_limit')) {
    /**
     * Return the csv_import_limit
     */
    function get_csv_import_limit()
    {
        return config('system_settings.csv_import_limit') ?: config('system.csv_import_limit', 50);
    }
}


if (!function_exists('get_sender_email')) {
    /**
     * Return system email
     */
    function get_sender_email()
    {
        return config('system_settings.system_email') ?: config('mail.from.address');
    }
}

if (!function_exists('get_sender_name')) {
    /**
     * Return organization title or the application title
     */
    function get_sender_name($shop = Null)
    {
        return config('branch_settings.branch.name') ?: config('company_settings.company.name');
    }
}

if (!function_exists('getAllowedMinImgSize')) {
    /**
     * Return min_img_size_limit_kb allowed to upload
     */
    function getAllowedMinImgSize()
    {
        return config('system_settings.min_img_size_limit_kb') ?: config('image.min_size', 0);
    }
}

if (!function_exists('getAllowedMaxImgSize')) {
    /**
     * Return max_img_size_limit_kb allowed uploading
     */
    function getAllowedMaxImgSize()
    {
        return config('system_settings.max_img_size_limit_kb') ?: config('image.max_size', 1024);
    }
}


if (!function_exists('highlightWords')) {
    function highlightWords($content = Null, $words = Null)
    {
        if ($content == Null || $words == Null) {
            return $content;
        }

        if (is_array($words)) {
            foreach ($words as $word) {
                $content = str_ireplace($word, '<mark>' . $word . '</mark>', $content);
            }

            return $content;
        }

        return str_ireplace($words, '<mark>' . $words . '</mark>', $content);
    }
}

if (!function_exists('clear_encoding_str')) {
    function clear_encoding_str($value)
    {
        if (is_array($value)) {
            $clean = [];

            foreach ($value as $key => $val) {
                $clean[$key] = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }

            return $clean;
        }

        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }
}

if (!function_exists('temp_storage_dir')) {
    function temp_storage_dir($dir = '')
    {
        return Str::finish(public_path("temp/{$dir}"), '/');
    }
}

if (!function_exists('file_storage_dir')) {
    function file_storage_dir($dir = '')
    {
        return "files";
        // return Str::finish("attachments/{$dir}", '/');
    }
}

if (!function_exists('get_file_url')) {
    function get_file_url($path)
    {
        if ($path) {
            return asset('storage/' . $path);
        }

        return null;
    }
}

if (!function_exists('image_storage_dir')) {
    function image_storage_dir()
    {
        return config('image.dir');
    }
}

if (!function_exists('sys_image_path')) {
    function sys_image_path($dir = '')
    {
        return Str::finish("images/{$dir}", '/');
    }
}

if (!function_exists('image_storage_path')) {
    function image_storage_path($path = Null)
    {
        $path = image_storage_dir() . '/' . $path;
        return Str::finish($path, '/');
    }
}

if (!function_exists('image_cache_path')) {
    function image_cache_path($path = Null)
    {
        $path = config('image.cache_dir') . '/' . $path;

        return Str::finish($path, '/');
    }
}

if (!function_exists('get_storage_file_url')) {
    function get_storage_file_url($path = null, $size = 'small')
    {
        if (! $path) {
            return null;
        }

        return url('public/storage/'.$path);

      /*  if ($size == Null) {
            return url("image/{$path}");
        }
        return url("image/{$path}?p={$size}");*/
    }
}


if (!function_exists('get_placeholder_img')) {
    function get_placeholder_img($size = 'small')
    {
        $size = config("image.sizes.{$size}");

        if ($size && is_array($size)) {
            return "https://placehold.it/{$size['w']}x{$size['h']}/eee?text=" . trans('app.no_img_available');
        }

        return url("images/placeholders/no_img.png");
    }
}


if (!function_exists('get_formattd_file_size')) {
    /**
     * Get the formated file size.
     * @param int $bytes
     * @param int $precision
     * @return str formated size string
     */
    function get_formatted_file_size($bytes = 0, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('get_cent_from_dollar')) {
    /**
     * Get cent from decimal amount value.
     *
     * @param decimal $value
     *
     * @return int
     */
    function get_cent_from_dollar($value = 0)
    {
        $value = number_format($value, 2, config('system_settings.currency.decimal_mark', '.'), '');

        return (int)($value * 100);
    }
}

if (!function_exists('get_dollar_from_cent')) {
    /**
     * Get doller from cent decimal value.
     *
     * @param decimal $value
     *
     * @return int
     */
    function get_dollar_from_cent($value = 0)
    {
        $value = number_format($value, 2, config('system_settings.currency.decimal_mark', '.'), '');

        return (int)($value / 100);
    }
}


if (!function_exists('get_formatted_decimal')) {
    function get_formatted_decimal($value = 0, $trim = true, $decimal = 0)
    {
        $decimal_mark = config('system_settings.currency.decimal_mark', '.');

        $value = number_format($value, $decimal, $decimal_mark, config('system_settings.currency.thousands_separator', ','));

        if ($trim) {
            $arr = explode($decimal_mark, $value);
            if (count($arr) == 2) {
                $temp = rtrim($arr[1], '0');
                $value = $temp ? $arr[0] . $decimal_mark . $temp : $arr[0];
            }
        }

        return $value;
    }
}


if (!function_exists('get_formatted_currency')) {
    function get_formatted_currency($value = 0, $decimal = null)
    {
        //dd(get_system_currency());
        if ($decimal && in_array(get_system_currency(),
                is_array(config('system.non_decimal_currencies'))
                    ? config('system.non_decimal_currencies')
                    : []))
        {
            $decimal = Null;
        }

        $value = get_formatted_decimal($value, $decimal ? false : true, $decimal);

        return get_currency_prefix() . $value . get_currency_suffix();
    }
}

if (!function_exists('get_currency_prefix')) {
    function get_currency_prefix()
    {
        return config('system_settings.currency.symbol_first') ? get_formated_currency_symbol() : '';
    }
}

if (!function_exists('get_currency_suffix')) {
    function get_currency_suffix()
    {
        return config('system_settings.currency.symbol_first') ? '' : get_formated_currency_symbol();
    }
}

if (!function_exists('get_formated_currency_symbol')) {
    function get_formated_currency_symbol()
    {
        if (config('system_settings.show_currency_symbol')) {

            if (config('system_settings.currency.symbol_first')) {
                return get_currency_symbol() . (config('system_settings.show_space_after_symbol') ? ' ' : '');
            }

            return (config('system_settings.show_space_after_symbol') ? ' ' : '') . get_currency_symbol();
        }

        return '';
    }
}


if (!function_exists('get_currency_code')) {
    function get_currency_code()
    {
        return config('system_settings.currency.iso_code') ?? 'USD';
    }
}


if (!function_exists('file_upload_max_size')) {
    // Returns a file size limit in bytes based on the PHP upload_max_filesize
    // and post_max_size
    function file_upload_max_size()
    {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $post_max_size = parse_size(ini_get('post_max_size'));
            if ($post_max_size > 0) {
                $max_size = $post_max_size;
            }

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = parse_size(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }
        return format_bytes($max_size);
    }
}


if (!function_exists('format_bytes')) {
    function format_bytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('get_percentage_of')) {
    function get_percentage_of($old_num, $new_num)
    {
        return get_formatted_decimal((($old_num - $new_num) * 100) / $old_num);
    }
}


if (!function_exists('get_flag_img_by_code')) {
    function get_flag_img_by_code($code, $plain = false)
    {
        $full_path = sys_image_path('flags') . $code . '.png';

        if (!file_exists($full_path)) {
            $full_path = sys_image_path('flags') . 'default.gif';
        }

        if ($plain) {
            return asset($full_path);
        }

        return '<img src="' . asset($full_path) . '" alt="' . $code . '"/>';
    }
}


if (!function_exists('get_formatted_country_name')) {
    function get_formatted_country_name($country, $code = null)
    {
        if (is_numeric($country)) {
            $country_data = \DB::table('countries')->select('iso_code', 'name')->find($country);
            $country = $country_data->name;
            $code = $country_data->iso_code;
        }

        if ($code) {
            return get_flag_img_by_code($code) . ' <span class="indent5">' . $country . '</span>';
        }

        return $country;
    }
}


if (!function_exists('get_states_of')) {
    /**
     * Get states ids of given countries.
     *
     * @param int $countries
     *
     * @return array
     */
    function get_states_of($countries, $all = False)
    {
        $states = \DB::table('states');

        if (is_array($countries)) {
            $states->whereIn('country_id', $countries);
        } else {
            $states->where('country_id', $countries);
        }

        if (!$all) {
            $states->where('active', 1);
        }

        return $states->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
    }
}


if (!function_exists('find_string_in_array')) {
    /**
     * find string or sub_string in array of string
     */
    function find_string_in_array($arr, $string)
    {
        return array_filter($arr, function ($value) use ($string) {
            return strpos($value, $string) !== false;
        });
    }
}

if (!function_exists('get_value_from')) {
    /**
     * Get value from a given table and id
     *
     * @param int $ids The primary keys
     * @param str $table
     * @param mix $field
     *
     * @return mix
     */
    function get_value_from($ids, $table, $field)
    {
        if (is_array($ids)) {
            $values = \DB::table($table)->select($field)->whereIn('id', $ids)->get()->toArray();

            if (!empty($values)) {
                $result = [];
                foreach ($values as $value) {
                    $result[] = $value->$field;
                }

                return $result;
            }
        } else {
            $value = \DB::table($table)->select($field)->where('id', $ids)->first();

            if (!empty($value) && isset($value->$field)) {
                return $value->$field;
            }
        }

        return null;
    }
}

if (!function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param string|array $route
     * @param string $className
     * @return string
     */
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }

        if (Route::currentRouteName() == $route) {
            return $className;
        }

        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}

if (!function_exists('date_filter_filed')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param string|array $route
     * @param string $className
     * @return string
     */
    function date_filter_filed($col)
    {
       return (' <div class="col-md-'.$col.'">
                <div class="col-md-6">
                    <input type="text" class="form-control datePicker" autocomplete="off" name="from_date" id="from-date-filter" placeholder="'.trans('app.from_date').'">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control datePicker" autocomplete="off" name="to_date" id="to-date-filter" placeholder="'.trans('app.to_date').'">
                </div>
            </div>');
    }
}


if (!function_exists('attendance_status')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param string|array $route
     * @param string $className
     * @return string
     */
    function attendance_status($status, $label = null)
    {
        if ($label){
            return (($status == RootModel::PRESENT)
                ? 'Present'
                : 'Absent'
            );
        }
        return (($status == RootModel::PRESENT)
            ? '<span> <i class="fa fa-check" style="font-size: xx-large;color: #0eaa6f;"></i></span>'
            : '<span> <i class="fa fa-close" style="font-size: xx-large;color: darkred;"></i></span>'
        );
    }
}

if (! function_exists('get_sms_status')) {
    /**add new button*/
    function get_sms_status($status)
    {
        return (($status ==\Modules\Notification\Entities\SmsLog::SENT)
            ? '<span> <i class="fa fa-check" style="font-size: xx-large;color: #0eaa6f;"></i></span>'
            : '<span> <i class="fa fa-close" style="font-size: xx-large;color: darkred;"></i></span>'
        );
    }
}

if (! function_exists('get_email_status')) {
    /**add new button*/
    function get_email_status($status)
    {
        return (($status ==\Modules\Notification\Entities\EmailLog::SENT)
            ? '<span> <i class="fa fa-check" style="font-size: xx-large;color: #0eaa6f;"></i></span>'
            : '<span> <i class="fa fa-close" style="font-size: xx-large;color: darkred;"></i></span>'
        );
    }
}

if (! function_exists('employee_search_filed')) {
    /**Employee  search filed*/
    function employee_search_filed($col)
    {
        return ('<div class="col-md-'.$col.'">
                 <select class="full-width form-control select2-ajax w-100" data-text="'.trans('help.search_employee').'"
                         data-link="'.route('employee.getEmployee').'" name="employee_id" id="employee-filter">
                     <option value="">'.trans('app.select_employee').'</option>
                 </select>
             </div>
             ');
    }
}

if (! function_exists('month_search_filed')) {
    /**Month search filed*/
    function month_search_filed($col)
    {
        $period = Illuminate\Support\Carbon::now()->subMonths(12)->monthsUntil(now());
        $options = '';
        foreach($period as $date):
            $selected = (request()->get('month') == $date->format('Y-m') ? "selected" : '');
            $options .= '<option value="'.$date->format('Y-m').'" '.$selected.'>'. $date->format('F-Y').'</option>';
        endforeach;

        return('<div class="col-md-'.$col.'">
                    <select class="form-control" name="month" id="month-filter">
                        <option value="">'.trans('app.select_month').'</option>
                       '.$options.'
                    </select>
                </div>
             ');
    }
}

if (! function_exists('leave_policy_apply_at')) {
    /**Month search filed*/
    function leave_policy_apply_at($apply_at)
    {
        switch ($apply_at){
            case \Modules\Organization\Entities\LeavePolicy::APPLY_AFTER_JOINING
            : return "After Joining";
            break;
            case \Modules\Organization\Entities\LeavePolicy::APPLY_AFTER_PROVISION
            : return "After Provision";
            break;

            default : return null;
        }
    }
}


if (! function_exists('notice')) {
    /**Month search filed*/
    function notice($type, $msg) : string
    {
        return '<div class="alert alert-'.$type.' alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>'.$type.'!</strong> '.$msg.'
                </div>';

    }
}

if (! function_exists('save_image')) {
    /**Month search filed*/
    function save_image($image)
    {
        if (getAllowedMaxImgSize() < number_format($image->getSize() / 1048576,2)){
            Session::flash('error', 'image size too big');
            return false;
        }

        $dir = image_storage_dir();
        if(! Storage::exists($dir)) {
            Storage::makeDirectory($dir, 0775, true, true);
        }
        $path = Storage::put($dir, $image);

        return $path;

    }
}






