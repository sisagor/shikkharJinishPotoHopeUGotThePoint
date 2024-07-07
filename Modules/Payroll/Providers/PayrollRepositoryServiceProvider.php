<?php

namespace Modules\Payroll\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Payroll\Repositories\SalaryRepository;
use Modules\Payroll\Repositories\PayrollRepository;
use Modules\Payroll\Repositories\SalaryRepositoryInterface;
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

        //Salary Repository.
        $this->app->singleton(
            SalaryRepositoryInterface::class,
            SalaryRepository::class,

        );

    }

}
