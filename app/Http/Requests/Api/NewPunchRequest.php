<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\RootRequest;
use Illuminate\Support\Facades\Auth;

class NewPunchRequest extends RootRequest
{
    public function authorize()
    {
       return true;
    }

    public function rules()
    {
        return [
            'punch_time' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
