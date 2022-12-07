<?php

namespace Modules\Organization\Http\Requests;

use App\Http\Requests\RootRequest;

class DesignationUpdateRequest extends RootRequest{

    public function authorize()
    {
        return is_company_group() || is_admin_group();
    }

    public function rules()
    {
        return [
            "name"    => 'required|min:3|unique:designations,name,'.$this->designation->id,
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
