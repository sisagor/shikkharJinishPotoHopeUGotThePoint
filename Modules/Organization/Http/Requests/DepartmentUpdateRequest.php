<?php

namespace Modules\Organization\Http\Requests;

use App\Http\Requests\RootRequest;

class DepartmentUpdateRequest extends RootRequest{

    public function authorize()
    {
        return is_admin_group() || is_company_group();
    }

    public function rules()
    {
        return [
            "name" => 'required|min:3|unique:departments,name,'.$this->department->id,
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
