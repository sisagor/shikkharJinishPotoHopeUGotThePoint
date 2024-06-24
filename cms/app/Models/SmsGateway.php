<?php

namespace App\Models;


class SmsGateway extends RootModel
{

    protected $table = 'sms_gateway';

    protected $fillable = ['id', 'driver', 'details', 'status'];
    public static $fetch = ['id', 'driver', 'details', 'status'];
}
