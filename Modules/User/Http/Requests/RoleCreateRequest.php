<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\RootRequest;

class RoleCreateRequest extends RootRequest{

    public function authorize()
    {

        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|unique:roles|max:255',
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
