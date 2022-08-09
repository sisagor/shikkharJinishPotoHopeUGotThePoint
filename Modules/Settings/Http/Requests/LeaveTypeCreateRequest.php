<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class LeaveTypeCreateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            'type' => 'required',
            'details' => 'required',
            'days' => 'required',
            'name' => 'required|unique:leave_types',
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
