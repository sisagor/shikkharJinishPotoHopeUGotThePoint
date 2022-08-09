<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class LeaveTypeUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group() || is_admin_group();
    }

    public function rules()
    {
        return [
            'type' => 'required',
            'details' => 'required',
            'days' => 'required',
            'name' => 'required|unique:leave_types,name,' . $this->leaveType->id,
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
