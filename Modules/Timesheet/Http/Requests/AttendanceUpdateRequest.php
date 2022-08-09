<?php

namespace Modules\Timesheet\Http\Requests;

use App\Http\Requests\RootRequest;

class AttendanceUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'checkout_time' => 'required',
            'checkout_date' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
