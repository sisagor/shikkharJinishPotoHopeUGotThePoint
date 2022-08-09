<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Common\CheckModulePermissions;
use App\Exceptions\UnauthorizedException;


class CheckActionPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Check if logged out of destroy session then clear the cache:
        if (Auth::user()) {
            //Check permission
            if (! CheckModulePermissions::hasPermission()) {
                throw new UnauthorizedException('Unauthorized action', 403);
            }
        }

        return $next($request);
    }
}
