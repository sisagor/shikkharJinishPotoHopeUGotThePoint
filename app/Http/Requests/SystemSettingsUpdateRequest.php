<?php

namespace App\Http\Requests;

class SystemSettingsUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_admin_group();
    }

    public function rules()
    {
        return [
            'system_name' => 'required',
            'system_phone' => 'required',
            'system_email' => 'required',
            'pagination' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
