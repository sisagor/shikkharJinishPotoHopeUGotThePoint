<?php

namespace Modules\Branch\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Branch\Repositories\BranchRepository;
use Modules\Branch\Repositories\BranchRepositoryInterface;


class BranchRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
            BranchRepositoryInterface::class,
            BranchRepository::class,

        );

    }

}
