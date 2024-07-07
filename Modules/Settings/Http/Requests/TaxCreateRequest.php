<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class TaxCreateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            'eligible_amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
