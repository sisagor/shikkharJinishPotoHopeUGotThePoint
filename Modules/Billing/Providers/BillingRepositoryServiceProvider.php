<?php

namespace Modules\Billing\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Billing\Repositories\BillingRepository;
use Modules\Billing\Repositories\BillingRepositoryInterface;


class BillingRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
            BillingRepositoryInterface::class,
            BillingRepository::class,
        );
    }
}
