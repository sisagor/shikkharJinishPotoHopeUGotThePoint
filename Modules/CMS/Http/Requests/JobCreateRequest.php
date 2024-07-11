<?php

namespace Modules\CMS\Http\Requests;

use App\Http\Requests\RootRequest;


class JobCreateRequest extends RootRequest
{
    public function authorize()
    {
        return ! is_employee();
    }

    public function rules()
    {

        if ($this->job){
            $required = ['status' => 'required',];
        }
        else{
            $required = [];
        }

        return array_merge([
            'position' => 'required',
            'details' => 'required',
            'requirements' => 'required',
            'vacancy' => 'required',
            'expire_date' => 'required',
            'experience' => 'required',
        ], $required);
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
