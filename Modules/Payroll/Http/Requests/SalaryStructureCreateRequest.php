<?php

namespace Modules\Payroll\Http\Requests;

use App\Http\Requests\RootRequest;

class SalaryStructureCreateRequest extends RootRequest{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required|unique:salary_structures|min:3",
            'type' => "required",
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
