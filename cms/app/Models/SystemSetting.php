<?php

namespace App\Models;


class SystemSetting extends RootModel
{

    protected $table = "system_settings";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    protected $fillable = ['key', 'value'];

}
