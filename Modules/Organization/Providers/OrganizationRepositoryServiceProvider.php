<?php

namespace Modules\Organization\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Organization\Repositories\DepartmentRepository;
use Modules\Organization\Repositories\DesignationRepository;
use Modules\Organization\Repositories\LeavePolicyRepository;
use Modules\Organization\Repositories\DeductionPolicyRepository;
use Modules\Organization\Repositories\DepartmentRepositoryInterface;
use Modules\Organization\Repositories\DesignationRepositoryInterface;
use Modules\Organization\Repositories\LeavePolicyRepositoryInterface;
use Modules\Organization\Repositories\DeductionPolicyRepositoryInterface;


class OrganizationRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //DDepartment
        $this->app->singleton(
            DepartmentRepositoryInterface::class,
            DepartmentRepository::class,
        );
        //Designation
        $this->app->singleton(
            DesignationRepositoryInterface::class,
            DesignationRepository::class,
        );
        //Leave Policy
        $this->app->singleton(
            LeavePolicyRepositoryInterface::class,
            LeavePolicyRepository::class,
        );
        //Deduction Policy
        $this->app->singleton(
            DeductionPolicyRepositoryInterface::class,
            DeductionPolicyRepository::class,
        );
    }

}
