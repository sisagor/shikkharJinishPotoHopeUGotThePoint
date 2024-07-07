<?php

namespace Modules\Timesheet\Http\Requests;

use App\Http\Requests\RootRequest;
use Illuminate\Support\Carbon;
use Modules\Settings\Entities\LeaveType;
use Modules\Timesheet\Entities\LeaveApplication;

class LeaveCreateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $data = [];

        if ($this->get('leave_for') == LeaveApplication::TYPE_DAYS) {
            $data = [
                'start_date' => 'required',
                'end_date' => 'required',
                'type_id' => 'required'
            ];
        }
        if ($this->get('leave_for') == LeaveApplication::TYPE_HOUR) {
            $data = [
                'leave_hour_date' => 'required',
                'leave_hour' => 'required'
            ];
        }

        return array_merge([
            'details' => 'required',
        ], $data);
    }


    public function message(bool $absolute = true)
    {
        return [
        ];
    }


}
