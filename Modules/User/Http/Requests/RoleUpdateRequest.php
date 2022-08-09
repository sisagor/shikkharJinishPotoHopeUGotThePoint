<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\RootRequest;

class RoleUpdateRequest extends RootRequest{

    public function authorize()
    {

        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required||max:255',
            //'level' => 'required',
            'status' => 'required',
            'actions' => 'required|array|min:1',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'A title is required',
            'actions.required' => 'role is required',
        ];
    }

}
