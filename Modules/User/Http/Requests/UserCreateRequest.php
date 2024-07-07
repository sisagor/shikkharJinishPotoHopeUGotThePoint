<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\RootRequest;

class UserCreateRequest extends RootRequest{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'phone' => 'required|between:6,15',
            'email' => 'required|unique:users',
            'gender' => 'required',
            'dob' => 'required',
            'status' => 'required',
            'role_id' => 'required',
            'password' => 'required|string|min:5|max:16|confirmed',
        ];
    }


    public function messages()
    {
        return [
            /* 'name.required' => 'A title is required',
             'role.required' => 'A message is required',*/
        ];
    }

}
