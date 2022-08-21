<?php

namespace App\Common;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
* @author Inta-Dev
 */
trait HasPermission
{

    public static function hasPermission(string $action): bool
    {
        $permissions =  Cache::get('action_'.Auth::id());
        //dd($permission);
        if(array_key_exists($action, $permissions)){
            return true;
        }
        return false;
    }


    public static function hasPermissionUrl($url): bool
    {
        //check if need to skip;
        if(self::skipPermission($url))
        {
            return true;
        }

        $permissions =  Cache::get('url_'.Auth::id());
        //check the permission;
        if(array_key_exists($url, $permissions))
        {
            return true;
        }
        return false;
    }


    /*Clear cache*/
    public static function clearCache(): bool
    {
        try {

            Cache::has('role_permissions_' . Auth::id());
            Cache::forget('action_' . Auth::id());
            Cache::forget('url_' . Auth::id());
        }
        catch(\Exception $exception)
        {
            Log::error("Menu permission cache cleaning error!!");
            Log::error(get_exception_message($exception));
        }
        return true;
    }


    private static function skipPermission($url): bool
    {
        $skips = config('permission.skip');

        if(request()->ajax()){
            return true;
        }

        if(str_contains($url, '/')) {
            $exp = explode('/', $url);
            $url = end($exp);
        }

        if (array_key_exists($url, $skips)) {
            return true;
        }

        return false;
    }

}
