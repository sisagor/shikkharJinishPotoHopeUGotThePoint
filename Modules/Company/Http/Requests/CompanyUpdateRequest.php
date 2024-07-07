<?php

namespace Modules\Company\Http\Requests;

use App\Http\Requests\RootRequest;

class CompanyUpdateRequest extends RootRequest
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
            'email' => 'required|email|unique:users,email,'.$this->company->user->id,
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
