<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Role\Repositories\RoleRepository;
use Modules\Role\Repositories\RoleRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        /*$this->app->singleton(
            RoleRepository::class,
            RoleRepositoryInterface::class,

        );*/

    }

}
