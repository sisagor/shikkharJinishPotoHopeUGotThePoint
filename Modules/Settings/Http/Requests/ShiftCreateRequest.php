<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class ShiftCreateRequest extends RootRequest
{

    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            "name" => "required|unique:shifts|min:3",
            'details' => "required",
            'start_time' => "required",
            'end_time' => "required",
            'status' => 'required',
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
