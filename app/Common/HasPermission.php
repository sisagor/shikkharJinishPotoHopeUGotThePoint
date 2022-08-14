<?php

namespace App\Common;

use Illuminate\Support\Facades\Cache;

/**
* @author Inta-Dev
 */
trait HasPermission
{

    public function hasPermission(string $permission): bool
    {
        $permissions = Cache::get('role_permissions');

        //dd($permission);
        if(! empty($permissions[$permission])){

            return true;
        }

        return false;
    }


}
