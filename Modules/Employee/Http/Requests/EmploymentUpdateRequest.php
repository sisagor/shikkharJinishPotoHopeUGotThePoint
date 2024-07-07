<?php

namespace Modules\Employee\Http\Requests;

use App\Http\Requests\RootRequest;

class EmploymentUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $data = [];

        if (config('company_settings.has_provision_period')) {
            array_push($data, ['provision_period' => 'required|regex:/[0-9]+/|between:1,12']);
        }

        $data = array_merge($data, [
            'basic_salary' => 'required|regex:/[0-9]+/|between:1,10',
            'department_id' => 'required',
            'designation_id' => 'required',
            'shift_id' => 'required',
            'type_id' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
        ]);

        return $data;
    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
