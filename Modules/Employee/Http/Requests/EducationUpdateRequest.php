<?php

namespace Modules\Employee\Http\Requests;

use App\Http\Requests\RootRequest;

class EducationUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'exam_title' => 'required',
            'institute' => 'required',
            'passing_year' => 'required',
            'cgpa' => 'required|numeric',
            'out_of' => 'required|numeric',
            'educational_qualification' => 'required',
            'actual_degree' => 'required|numeric',
            'educational_discipline' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }
}
