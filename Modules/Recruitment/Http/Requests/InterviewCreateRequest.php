<?php

namespace Modules\Recruitment\Http\Requests;

use App\Http\Requests\RootRequest;


class InterviewCreateRequest extends RootRequest
{
    public function authorize()
    {
        return ! is_employee();
    }

    public function rules()
    {

        if ($this->interview){
            $required = ['status' => 'required'];
        }
        else{
            $required = [];
        }

        return array_merge([
             'job_id' => 'required',
             'job_application_id' => 'required',
             'interview_date' => 'required',
             'interview_time' => 'required',
             'address' => 'required',
             'interviewers' => 'required|array|min:1',
             'details' => 'required',
        ], $required);
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
