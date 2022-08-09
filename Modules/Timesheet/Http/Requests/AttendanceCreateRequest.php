<?php

namespace Modules\Timesheet\Http\Requests;

use App\Http\Requests\RootRequest;
use Modules\Timesheet\Entities\Attendance;

class AttendanceCreateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'employee_id' => 'required|array|min:1',
            'punch_time' => 'required',
            'attendance_date' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
