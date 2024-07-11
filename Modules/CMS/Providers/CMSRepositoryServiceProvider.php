<?php

namespace Modules\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CMS\Repositories\CmsRepository;
use Modules\CMS\Repositories\JobRepository;
use Modules\CMS\Repositories\OfferRepository;
use Modules\CMS\Repositories\BlogRepository;
use Modules\CMS\Repositories\CmsRepositoryInterface;
use Modules\CMS\Repositories\JobRepositoryInterface;
use Modules\CMS\Repositories\JobApplicationRepository;
use Modules\CMS\Repositories\OfferRepositoryInterface;
use Modules\CMS\Repositories\BlogRepositoryInterface;
use Modules\CMS\Repositories\JobApplicationRepositoryInterface;


class CMSRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->singleton(
           JobRepositoryInterface::class,
            JobRepository::class
        );

        $this->app->singleton(
           JobApplicationRepositoryInterface::class,
            JobApplicationRepository::class
        );

        $this->app->singleton(
           BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->singleton(
           OfferRepositoryInterface::class,
            OfferRepository::class
        );
        $this->app->singleton(
           CmsRepositoryInterface::class,
            CmsRepository::class
        );

    }

}
