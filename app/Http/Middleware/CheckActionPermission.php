<?php

namespace App\Http\Middleware;

use Closure;
use App\Common\HasPermission;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UnauthorizedException;


class CheckActionPermission
{
    use HasPermission;
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
        if (Auth::user())
        {
            //Check permission
            if ($request->method() !== "POST" && ! self::hasPermissionUrl(get_menu_url())) {
                abort('403');
            }
        }

        return $next($request);
    }
}
