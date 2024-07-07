<?php

namespace Modules\Payroll\Http\Requests;

use App\Http\Requests\RootRequest;

class SalaryPayCreateRequest extends RootRequest
{

    public function authorize()
    {
        return is_company_admin() || is_branch_admin();
    }

    public function rules()
    {
        return [
            'is_paid' => 'required',
            'amount' => 'required|numeric',
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
