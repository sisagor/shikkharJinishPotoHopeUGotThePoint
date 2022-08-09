<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\RoleNotFoundException;
use App\Exceptions\UserInactiveException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;



class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */

    public function handle($request, Closure $next, ...$guards)
    {
        if (! auth()->user()) {
            return redirect()->route('login');
        }

        if (! is_super_admin() && ! role_id()) {
            auth()->logout();
            throw new RoleNotFoundException(trans('msg.role_not_found'));
        }

        if (! Auth::user()->status) {
            auth()->logout();
            throw new UserInactiveException(trans('msg.user_inactive'));
        }

        ///Cache::forget('role_permissions_'.Auth::id());

        return $next($request);
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
