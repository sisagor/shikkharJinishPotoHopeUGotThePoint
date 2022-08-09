<?php

namespace Modules\Branch\Http\Requests;

use App\Http\Requests\RootRequest;

class BranchCreateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'role_id' => 'required',
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
