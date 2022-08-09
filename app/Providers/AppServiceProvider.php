<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


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

        try {
            // Ondemand Img manupulation
            $this->app->singleton(\League\Glide\Server::class, function ($app) {

                $filesystem = $app->make(\Illuminate\Contracts\Filesystem\Filesystem::class);

                return \League\Glide\ServerFactory::create([
                    'response' => new \League\Glide\Responses\LaravelResponseFactory(app('request')),
                    'driver' => config('image.driver'),
                    'presets' => config('image.sizes'),
                    'source' => $filesystem->getDriver(),
                    'cache' => $filesystem->getDriver(),
                    'cache_path_prefix' => config('image.cache_dir'),
                    'base_url' => 'image', //Don't change this value
                ]);
            });

        } catch (\Exception $exception) {
            Log::error("Image manipulator error");
            Log::info($exception->getMessage());
        }

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
