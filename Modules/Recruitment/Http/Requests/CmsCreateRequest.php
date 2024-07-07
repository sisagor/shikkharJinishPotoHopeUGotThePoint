<?php

namespace Modules\Recruitment\Http\Requests;

use App\Http\Requests\RootRequest;


class CmsCreateRequest extends RootRequest
{
    public function authorize()
    {
        return ! is_employee();
    }

    public function rules()
    {


        return [
            'status' => 'required',
            'type' => 'required',
            'content' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
