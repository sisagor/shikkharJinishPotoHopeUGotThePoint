<?php

namespace App\Http\Middleware;

use Closure;

class NotificationMarkAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param Redirector $redirect
     * @return mixed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('markAsRead')) {
            $notification = $request->user()->notifications()->where('id', $request->read)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        
        return $next($request);
    }


}
