<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class EmployeeTypeUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            'details' => 'required',
            'status' => 'required',
            'allow_company_facility' => 'required',
            'name' => 'required|unique:employee_types,name,' . $this->type->id,
        ];
    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
