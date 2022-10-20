<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Menu;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class InitModuleCache
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //\Artisan::call('optimize');
        if (Auth::user()) {
            //Cache all modules from permission:
            $this->cacheModulePermissions();
        }
        //dd(Cache::has('user'));

        return $next($request);
    }

    /**Cache module and permissions */
    private function cacheModulePermissions(): bool
    {
        if (is_super_admin()) {

            Cache::rememberForever('role_permissions_' . Auth::id(), function () {
                return Module::with(['submodules' => function ($submodule) {
                    $submodule->select(['id', 'name', 'module_id', 'show'])
                        ->with(['menu' => function ($menu) {
                            $menu->select(['id', 'name', 'show', 'submodule_id', 'url', 'action'])
                                ->orderby('id', 'asc');
                        }])
                        ->active()
                        ->orderBy('order', 'asc');
                }])
                    ->select('id', 'name', 'url', 'icon')
                    ->active()
                    ->orderBy('order', 'asc')
                    ->get();
            });

            return true;
        }

        Cache::rememberForever('role_permissions_' . Auth::id(), function () {
            return Module::whereHas('permissions', function ($role) {
                return $role->where('role_id', Auth::user()->role_id);
            })
                ->with(['submodules' => function ($submodule) {
                    return $submodule->whereHas('permissions', function ($role) {
                        $role->where('role_id', Auth::user()->role_id);
                    })
                        ->with(['menu' => function ($menu) {
                            $menu->whereHas('permissions', function ($role) {
                                $role->where('role_id', Auth::user()->role_id);
                            })
                                ->select(['id', 'name', 'show', 'submodule_id', 'url', 'action'])
                                ->orderby('id', 'asc');
                        }])
                        ->select(['id', 'name', 'module_id', 'show'])
                        ->active()
                        ->orderBy('order', 'asc');

                }])
                ->select('id', 'name', 'url', 'icon')
                ->active()
                ->orderBy('order', 'asc')
                ->get();
        });

        Cache::rememberForever('action_' . Auth::id(), function () {
            return Menu::pluck('url', 'action')->toArray();
        });

        Cache::rememberForever('url_' . Auth::id(), function () {
            return Menu::pluck('action', 'url')->toArray();
        });

        return true;
    }

}
