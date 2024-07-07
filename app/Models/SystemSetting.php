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


    public function timezone()
    {
        return $this->belongsTo(Timezone::class, 'timezone_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

}
