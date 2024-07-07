<?php

namespace Modules\Loan\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Loan\Repositories\LoanRepository;
use Modules\Loan\Repositories\LoanRepositoryInterface;


class LoanRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
           LoanRepositoryInterface::class,
            LoanRepository::class
        );

    }

}
