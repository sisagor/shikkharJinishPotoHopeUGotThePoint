<?php

namespace Modules\Company\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Company\Repositories\CompanyRepository;
use Modules\Company\Repositories\CompanyRepositoryInterface;


class CompanyRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
            CompanyRepositoryInterface::class,
            CompanyRepository::class,

        );

    }

}
