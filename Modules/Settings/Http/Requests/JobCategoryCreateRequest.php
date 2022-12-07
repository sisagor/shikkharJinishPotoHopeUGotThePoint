<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class JobCategoryCreateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:job_categories,com_id,' . com_id(),
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
