<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\RootRequest;

class UserPasswordUpdateRequest extends RootRequest{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'current_password' => 'required',
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
