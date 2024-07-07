<?php

namespace Modules\Billing\Http\Requests;

use App\Http\Requests\RootRequest;

class ProjectUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return has_permission('billing.project.add');
    }

    public function rules()
    {
        return [
            'manager_id' => 'required',
            'name' => 'required|unique:projects,name,'.$this->project->id,
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
