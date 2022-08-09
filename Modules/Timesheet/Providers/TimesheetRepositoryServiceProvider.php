<?php

namespace Modules\Timesheet\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Timesheet\Repositories\LeaveRepository;
use Modules\Timesheet\Repositories\AttendanceRepository;
use Modules\Timesheet\Repositories\LeaveRepositoryInterface;
use Modules\Timesheet\Repositories\AttendanceRepositoryInterface;
use Modules\Timesheet\Repositories\TimesheetRepository;
use Modules\Timesheet\Repositories\TimesheetRepositoryInterface;


class TimesheetRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Leave Repository.
        $this->app->singleton(
            LeaveRepositoryInterface::class,
            LeaveRepository::class,
        );

        //Attendance Repository.
        $this->app->singleton(
            AttendanceRepositoryInterface::class,
            AttendanceRepository::class,
        );

        //Dashboard Repository.
        $this->app->singleton(
            TimesheetRepositoryInterface::class,
            TimesheetRepository::class,
        );

    }

}
