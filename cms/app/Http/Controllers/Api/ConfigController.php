<?php

namespace App\Http\Controllers\Api;


use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Resources\ConfigurationResource;


class ConfigController extends BaseController
{

    public function configuration(Request $request)
    {
        try {

            if (config('app.url') == $request->get('domain')) {

                $data = SystemSetting::with('logo', 'timezone:id,utc', 'currency:id,name,symbol')->first();

                return $this->handleResponse(new ConfigurationResource($data), 'success');
            }
            else
            {
                return $this->handleError('Domain not found!', 'failed');
            }

        }
        catch (\Exception $exception){
            return $this->handleError(get_exception_message($exception), 'failed');
        }

    }

}
