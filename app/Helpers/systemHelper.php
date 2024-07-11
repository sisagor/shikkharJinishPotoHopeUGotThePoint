<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Notifications\ActivityNotification;


if (! function_exists('sendActivityNotification')) {
    /**
     * send activity notification
     */
    function sendActivityNotification($activity, $optional = null)
    {
        if (config('system_settings.notifiable'))
        {
            config('system_settings.notifiable')->notify(new ActivityNotification(config('system_settings.notifiable.id'), $activity, $optional));
        }
    }
}

if (! function_exists('sendEmailNotification')) {
    /**
     * send email notification
     */
    function sendEmailNotification($job)
    {
        if (config('system_settings.email_notification')) {
            dispatch($job)->delay(Carbon::now()->addMinutes(config('system.email_delay')));
        }
    }
}



if (! function_exists('setSystemLocale')) {
    /**
     * Set system locale into the config
     */
    function setSystemLocale()
    {
        // Set the default_language
        app()->setLocale(config('system_settings.default_language'));

        //$active_locales = ::availableLocales();

        //config()->set('active_locales', $active_locales);
    }
}

if (! function_exists('setSystemTimezone')) {
    /**
     * Set system timezone into the config
     */
    function setSystemTimezone()
    {
        $system_timezone = system_timezone();
        if ($system_timezone) {
            \Illuminate\Support\Facades\Config::set('app.timezone', $system_timezone);

            date_default_timezone_set($system_timezone);
        }
    }
}

if (! function_exists('convertFromUTC')) {
    /**
     * @param integer $timestamp
     * @param string $timezone
     *
     * @return Carbon
     */
    function convertFromUTC($timestamp, $timezone = Null)
    {
        return Carbon::parse($timestamp)->timezone(config('app.timezone', 'UTC'));
    }
}

if (! function_exists('setSystemCurrency')) {
    /**
     * Set system currency into the config
     */
    function setSystemCurrency()
    {
        $currency = getSystemCurrency();
        if ($currency) {
            config([
                'system_settings.currency' => [
                    'name' => $currency->name,
                    'symbol' => $currency->symbol,
                    'iso_code' => $currency->iso_code,
                    'symbol_first' => $currency->symbol_first,
                    'decimal_mark' => $currency->decimal_mark,
                    'thousands_separator' => $currency->thousands_separator,
                    'subunit' => $currency->subunit,
                ]
            ]);
        }
    }
}

if (! function_exists('getSystemCurrency')) {
    /**
     * Set system currency into the config
     */
    function getSystemCurrency()
    {
        return \Illuminate\Support\Facades\Cache::rememberForever('currencies_single', function () {
            return DB::table('currencies')
                ->select(['name', 'symbol', 'iso_code', 'symbol_first', 'decimal_mark', 'thousands_separator', 'subunit'])
                ->where('id', config('system_settings.currency_id'))
                ->first();
        });
    }
}



if (! function_exists('getMysqliConnection')) {
    /**
     * Return Mysqli connection object
     */
    function getMysqliConnection()
    {
        return mysqli_connect(config('database.connections.mysql.host', '127.0.0.1'), config('database.connections.mysql.username', 'root'), config('database.connections.mysql.password'), config('database.connections.mysql.database'), config('database.connections.mysql.port', '3306'));
    }
}



if (! function_exists('check_internet_connection')) {
    /**
     * Check Internet Connection Status.
     *
     * @param string $sCheckHost Default: www.google.com
     * @return           boolean
     */
    function check_internet_connection($sCheckHost = 'www.google.com')
    {
        return (bool)@fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
    }
}
