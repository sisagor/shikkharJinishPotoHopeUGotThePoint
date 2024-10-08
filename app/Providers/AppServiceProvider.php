<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Module;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(150);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Paginator::defaultView('vendor.pagination.default');
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        //Paginator::defaultView('vendor.pagination.semantic-ui');
        //dd(Auth::user());
    }
}
