<?php

namespace Modules\Recruitment\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Recruitment\Repositories\InterviewRepository;
use Modules\Recruitment\Repositories\InterviewRepositoryInterface;
use Modules\Recruitment\Repositories\JobRepository;
use Modules\Recruitment\Repositories\JobRepositoryInterface;
use Modules\Recruitment\Repositories\JobApplicationRepository;
use Modules\Recruitment\Repositories\JobApplicationRepositoryInterface;




class RecruitmentRepositoryServiceProvider extends ServiceProvider
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

    }

}
