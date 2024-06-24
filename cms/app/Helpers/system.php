<?php

if (! function_exists('setSystemConfig')) {
    /**
     * Set system settings into the config
     */
    function setSystemConfig()
    {
        config()->set('system_settings', system_settings());
        //config()->set('sms_gateway', sms_gateway());
        // set_time_limit(300); //
        //setSystemLocale();
        setSystemCurrency();
        setSystemTimezone();

        config()->set('system_settings.notifiable', set_notifiable_admin());

        if (com_id()) {
            config()->set('company_settings', company_settings());
            config()->set('company_settings.company', get_single_company(com_id()));
        }
    }
}


if (! function_exists('systemCheck')) {
    /**
     * Set system settings into the config
     * @throws  \App\Exceptions\LicenseNotFoundException
     */
    function systemCheck($request)
    {
        //Check mac if local, check if server;
        $mac = exec('getmac');
        //$mac = null;
        $mac = strtok($mac, ' ');
        //var_dump($mac);

        if ($mac){
            //home pc mac
            //dd($mac);
            //if($mac !== "60-14-B3-64-99-36") {
            //office Pc mac
            if($mac !== "60-45-CB-69-CB-06"){
                throw new \App\Exceptions\LicenseNotFoundException('Invalid License!');
            }
        }
        else
        {
            if ($request->ip() !== "103.146.92.10"){
                throw new  \App\Exceptions\LicenseNotFoundException('Invalid License!');
            }
        }
        //End check
    }
}
