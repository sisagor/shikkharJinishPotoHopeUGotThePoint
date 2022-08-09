<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class ShiftUpdateRequest extends RootRequest
{

    public function authorize()
    {
        return is_company_group() || is_admin_group();
    }

    public function rules()
    {
        return [
            "name" => 'required|min:3|unique:shifts,name,' . $this->shift->id,
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
