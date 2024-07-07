<?php

namespace Modules\Branch\Http\Requests;

use App\Http\Requests\RootRequest;

class BranchProfileUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_branch_admin();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->branch->user->id,
        ];

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
