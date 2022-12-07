<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class HolidayCreateRequest extends RootRequest
{

    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            "occasion" => "required|min:3",
            'start_date' => "required",
            'end_date' => "required",
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
