<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\RootRequest;

class UserUpdateRequest extends RootRequest{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'name' => 'required|max:255',
            'phone' => 'required|between:6,15',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->profile->user->id,
            'role_id' => 'required',
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
