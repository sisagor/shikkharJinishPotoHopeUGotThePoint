<?php

namespace Modules\Organization\Http\Requests;

use App\Http\Requests\RootRequest;

class DepartmentCreateRequest extends RootRequest{

    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            "name" => "required|unique:departments|min:3",
            'details' => "required",
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
