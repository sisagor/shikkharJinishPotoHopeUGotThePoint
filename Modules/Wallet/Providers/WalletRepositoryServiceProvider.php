<?php

namespace Modules\Wallet\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Wallet\Repositories\WalletRepository;
use Modules\Wallet\Repositories\WalletRepositoryInterface;


class WalletRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
            WalletRepositoryInterface::class,
            WalletRepository::class,
        );
    }

}
