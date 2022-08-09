<?php

namespace Modules\Company\Http\Requests;

use App\Http\Requests\RootRequest;

class CompanySettingsUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_company_admin();
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
