<?php

namespace Modules\Employee\Http\Requests;

use App\Http\Requests\RootRequest;

class EducationCreateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employee_id' => 'required',
            'exam_title' => 'required',
            'institute' => 'required',
            'passing_year' => 'required',
            'cgpa' => 'required|numeric',
            'out_of' => 'required|numeric',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
