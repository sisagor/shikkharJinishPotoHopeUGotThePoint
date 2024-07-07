<?php

namespace Modules\Billing\Http\Requests;

use App\Http\Requests\RootRequest;

class ProjectCreateRequest extends RootRequest
{
    public function authorize()
    {
        return has_permission('billing.project.add');
    }

    public function rules()
    {
        return [
            'manager_id' => 'required',
            'name' => 'required|unique:projects',
            'details' => 'required',
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        return [
        ];
    }


}
