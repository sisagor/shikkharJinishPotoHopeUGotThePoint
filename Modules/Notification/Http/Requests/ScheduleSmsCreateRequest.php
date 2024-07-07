<?php

namespace Modules\Notification\Http\Requests;

use App\Http\Requests\RootRequest;

class ScheduleSmsCreateRequest extends RootRequest
{

    public function authorize()
    {
        return is_admin_group() || is_company_group() || is_branch_group();
    }

    public function rules()
    {
        return [
            'delivery_type' => 'required',
            'delivery_time' => 'required',
            'numbers' => 'required',
            'body' => 'required',
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
