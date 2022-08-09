<?php

namespace Modules\Branch\Http\Requests;

use App\Http\Requests\RootRequest;

class BranchSettingsUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_branch_admin();
    }

    public function rules()
    {
        return [
            'attendance' => 'required',
        ];

    }


    public function message()
    {
        return [];
    }


}
