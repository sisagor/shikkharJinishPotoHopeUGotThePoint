<?php

namespace App\Http\Requests;

class SystemSettingsUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return is_admin();
    }

    public function rules()
    {
        return [];
    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
