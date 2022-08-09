<?php

namespace Modules\Payroll\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Payroll\Repositories\PayrollRepository;
use Modules\Payroll\Repositories\PayrollRepositoryInterface;


class PayrollRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
            PayrollRepositoryInterface::class,
            PayrollRepository::class,

        );

    }

}
