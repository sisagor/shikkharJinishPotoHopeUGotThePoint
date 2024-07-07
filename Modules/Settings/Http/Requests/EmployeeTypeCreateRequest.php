<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class EmployeeTypeCreateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:employee_types,com_id,' . com_id(),
            'details' => 'required',
            'allow_company_facility' => 'required',
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
