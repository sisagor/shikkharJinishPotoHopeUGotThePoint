<?php

namespace Modules\SMS\Http\Requests;

use App\Http\Requests\RootRequest;

class SmsCreateRequest extends RootRequest
{

    public function authorize()
    {
        return is_admin_group() || is_company_admin_group() || is_branch_admin_group();
    }

    public function rules()
    {
        return [
            'employees' => 'required|array|min:1',
            'sms' => 'required',
        ];
    }


    public function messages()
    {
        return [
            /* 'name.required' => 'A title is required',
             'role.required' => 'A message is required',*/
        ];
    }

}
