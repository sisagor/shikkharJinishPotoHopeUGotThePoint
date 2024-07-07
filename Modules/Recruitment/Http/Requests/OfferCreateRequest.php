<?php

namespace Modules\Recruitment\Http\Requests;

use App\Http\Requests\RootRequest;


class OfferCreateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group() || is_branch_group();
    }

    public function rules()
    {
        return [
             'job_id' => 'required',
             'job_application_id' => 'required',
             'title' => 'required',
             'details' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
