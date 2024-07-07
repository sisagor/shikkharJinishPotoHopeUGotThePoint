<?php

namespace Modules\Branch\Http\Requests;

use App\Http\Requests\RootRequest;

class BranchUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group() || is_admin_group();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            //'com_id' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->branch->user->id,
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
