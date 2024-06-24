<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\RootRequest;

class UserProfileUpdateRequest extends RootRequest{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'name' => 'required|max:255',
            'phone' => 'required|between:6,15',
            'email' => 'required|email|unique:users,email,'.$this->profile->user->id,
            'gender' => 'required',
            'dob' => 'required',
            'address' => 'required'
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
