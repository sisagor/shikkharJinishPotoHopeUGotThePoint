<?php

namespace Modules\Payroll\Http\Requests;

use App\Http\Requests\RootRequest;

class SalaryRuleCreateRequest extends RootRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "add_type" => "required|array|min:1",
            //'deduct_type' => "required|array|min:1",
            'name' => 'required',
            'designation_id' => 'required',
            'basic_salary' => 'required|numeric',
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
