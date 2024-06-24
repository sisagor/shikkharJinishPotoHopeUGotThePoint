<?php

namespace App\Http\Requests;

class JobApplicationRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:job_applications',
            'resume' => 'required',
            'cover_later' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
