<?php

namespace Modules\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Recruitment\Repositories\CmsRepository;
use Modules\Recruitment\Repositories\WalletRepository;
use Modules\Recruitment\Repositories\CmsRepositoryInterface;
use Modules\Recruitment\Repositories\JobRepository;
use Modules\Recruitment\Repositories\OfferRepository;
use Modules\Recruitment\Repositories\InterviewRepository;
use Modules\Recruitment\Repositories\JobRepositoryInterface;
use Modules\Recruitment\Repositories\JobApplicationRepository;
use Modules\Recruitment\Repositories\OfferRepositoryInterface;
use Modules\Recruitment\Repositories\InterviewRepositoryInterface;
use Modules\Recruitment\Repositories\JobApplicationRepositoryInterface;


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
           InterviewRepositoryInterface::class,
            InterviewRepository::class
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
