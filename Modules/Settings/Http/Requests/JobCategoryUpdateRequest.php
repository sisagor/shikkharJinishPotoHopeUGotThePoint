<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class JobCategoryUpdateRequest  extends RootRequest
{
    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            'details' => 'required',
            'status' => 'required',
            'name' => 'required|unique:job_categories,name,' . $this->jobCategory->id,
        ];
    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
