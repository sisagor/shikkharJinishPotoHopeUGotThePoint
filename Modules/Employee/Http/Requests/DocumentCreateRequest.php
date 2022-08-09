<?php

namespace Modules\Employee\Http\Requests;

use App\Http\Requests\RootRequest;

class DocumentCreateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'file' => 'required',
        ];
    }

    public function message(bool $absolute = true)
    {
        return [
        ];
    }


}
