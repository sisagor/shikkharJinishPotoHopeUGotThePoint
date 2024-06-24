<?php
namespace Modules\CMS\Providers;

//use Modules\CMS\Entities\JobOffer;
use Modules\CMS\Observers\JobOfferObserver;
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
        //JobOffer::observe(JobOfferObserver::class);
    }
}
