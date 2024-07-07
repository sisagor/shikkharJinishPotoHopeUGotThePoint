<?php
namespace Modules\Recruitment\Providers;

use Modules\Recruitment\Entities\JobOffer;
use Modules\Recruitment\Observers\JobOfferObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        JobOffer::observe(JobOfferObserver::class);
    }
}
