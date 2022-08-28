<?php

namespace App\Models;


use App\Common\Imageable;

class SystemSetting extends RootModel
{
    use Imageable;

    protected $table = "system_settings";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $timestampes = false;

    protected $casts = [
        'sms_events' => 'array',
    ];

    protected $fillable = [
        'system_name',
        'system_phone',
        'system_email',
        'sms_events',
        'email_notification',
        'pagination',
        'currency_id',
        'timezone_id',
        'show_currency_symbol',
        'show_space_after_symbol',
        'has_tax_policy',
        'system_realtime_notification',
        'mix',
        'phone_country_code',
        'store_email_log',
        'store_sms_log',
    ];

    public static $fetch = [
        'system_name',
        'system_phone',
        'system_email',
        'sms_events',
        'email_notification',
        'pagination',
        'currency_id',
        'timezone_id',
        'show_currency_symbol',
        'show_space_after_symbol',
        'has_tax_policy',
        'system_realtime_notification',
        'mix',
        'phone_country_code',
        'store_email_log',
        'store_sms_log',
    ];

    public function timezone()
    {
        return $this->belongsTo(Timezone::class, 'timezone_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

}
