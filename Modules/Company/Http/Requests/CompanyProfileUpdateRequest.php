<?php

namespace Modules\Company\Http\Requests;

use App\Http\Requests\RootRequest;

class CompanyProfileUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_admin();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'details' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->company->user->id,
        ];

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
