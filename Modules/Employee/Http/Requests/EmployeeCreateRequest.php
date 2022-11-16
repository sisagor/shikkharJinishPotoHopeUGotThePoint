<?php

namespace Modules\Employee\Http\Requests;

use App\Http\Requests\RootRequest;

class EmployeeCreateRequest extends RootRequest
{
    public function authorize()
    {
        return (! is_admin() && ! is_super_admin() && has_permission('employee.employee.add'));
    }

    public function rules()
    {

        $data = [];
        if (config('company_settings.allow_employee_login') && $this->has('create_user')) {
           $data = [
                'password' => 'required|string|min:5|max:16|confirmed',
                'role_id' => 'required',
           ];
        }

        $data = array_merge($data, [
            'name' => 'required',
            'phone' => 'required|max:15',
            'status' => 'required',
            'email' => 'required|email|unique:users|unique:employees',
            'employee_index' => 'required|string|unique:employees',
        ]);

        return $data;
    }


    public function message(bool $absolute = true)
    {
        return [
        ];
    }


}
