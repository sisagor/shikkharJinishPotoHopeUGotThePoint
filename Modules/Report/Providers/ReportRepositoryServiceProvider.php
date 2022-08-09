<?php

namespace Modules\Report\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Report\Repositories\ReportRepository;
use Modules\Report\Repositories\ReportRepositoryInterface;


class ReportRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
            ReportRepositoryInterface::class,
            ReportRepository::class,

        );

    }

}
