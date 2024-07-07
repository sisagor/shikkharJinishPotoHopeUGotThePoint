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
        if(! $this->get('notificationSetting')){
            return [
                'system_name' => 'required',
                'system_phone' => 'required',
                'system_email' => 'required',
                'pagination' => 'required',
            ];
        }
        else{
            return [

            ];
        }

    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
