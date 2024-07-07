<?php

namespace Modules\Employee\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Employee\Repositories\EmployeeRepositoryInterface;
use Modules\Employee\Repositories\LeaveAssignRepository;
use Modules\Employee\Repositories\LeaveAssignRepositoryInterface;


class EmployeeRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Role Module Repository.
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class,
        );
    }

}
