<?php

namespace Modules\Company\Http\Requests;

use App\Http\Requests\RootRequest;

class CompanyCreateRequest extends RootRequest
{
    public function authorize()
    {
        return is_admin_group();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:5|max:16|confirmed',
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
