<?php

namespace Modules\Organization\Http\Requests;

use App\Http\Requests\RootRequest;

class LeavePolicyCreateRequest extends RootRequest
{

    public function authorize()
    {
        return is_company_group();
    }

    public function rules()
    {
        $typeId = json_encode($this->get('type_id'));

        $this->merge(['type_id' => $typeId]);

        return [
            "type_id" => "required|array|min:1",
            "name" => "required",
            "apply_at" => "required",
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
