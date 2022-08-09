<?php

namespace Modules\Organization\Http\Requests;

use App\Http\Requests\RootRequest;

class DeductionCreateRequest extends RootRequest{

    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        return [
            "type" => "required",
            "absent" => "required|numeric",
            "deduction_amount" => "required|numeric",
            "details" => "required",
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
