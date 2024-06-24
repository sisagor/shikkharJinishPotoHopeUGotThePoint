<?php

namespace App\Common;


use App\Services\ZKTService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Company\Entities\CompanySetting;
use Modules\Timesheet\Entities\Attendance;

trait HasDevice
{

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            self::storeUpdate($model);

        });

        static::deleting(function ($model) {

            self::deleteDeviceEmp($model);
        });
    }


    /*Create or update Employee in device*/
    private static function storeUpdate($model)
    {
        $service = new ZKTService();

        if (self::check($service)){

            //$service->removeUser($model->id);
            //$service->clearAttendance();

            $service->setUser($model->id, $model->id, $model->funl_name, substr($model->phone, 5), 1, $model->card_no);

            dd($service->getUser());

            Session::flash('success',  $model->full_nem . ' employee success to create on device');
        }
        else{

            Session::flash('warning', $model->full_nem . ' employee failed to create on device');
            Log::error('Device Error');
            Log::info($model->full_nem . ' employee failed to create on device. try to update this employee');
        }

    }


    /*Delete Employee From device*/
    private static function deleteDeviceEmp($model)
    {
        $service = new ZKTService();

        if (self::check($service)){
            return $service->removeUser($model->id);
        }

    }


    protected function check($service){

        if
        (
            config('company_settings.enable_device')
            && config('company_settings.attendance') == CompanySetting::ATTENDANCE_IP
            && config('company_settings.device_ip')
            && $service->connect()
        )
        {
            return true;
        }
        if
        (
            config('branch_settings.enable_device')
            && config('branch_settings.attendance') == CompanySetting::ATTENDANCE_IP
            && config('branch_settings.device_ip')
            && $service->connect()
        )
        {
            return true;
        }

        return false;
    }


}
