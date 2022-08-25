<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This value determines which of the following gateway to use.
    | You can switch to a different driver at runtime.
    |
    */
    'default' => 'textlocal',

    /*
    |--------------------------------------------------------------------------
    | List of Drivers
    |--------------------------------------------------------------------------
    |
    | These are the list of drivers to use for this package.
    | You can change the name. Then you'll have to change
    | it in the map array too.
    |
    */
    'drivers' => [
        // Install: composer require aws/aws-sdk-php
        'sns' => [
            'key' => 'Your AWS SNS Access Key',
            'secret' => 'Your AWS SNS Secret Key',
            'region' => 'Your AWS SNS Region',
            'sender' => 'Your AWS SNS Sender ID',
            'type' => 'Tansactional', // Or: 'Promotional'
            'site_url' => 'https://aws.amazon.com/sns'
        ],
        'textlocal' => [
            'url' => 'http://api.textlocal.in/send/', // Country Wise this may change.
            'username' => 'Your Username',
            'hash' => 'Your Hash',
            'sender' => 'Sender Name',
            'site_url' => 'textlocal.com'
        ],
        // Install: composer require twilio/sdk
        'twilio' => [
            'sid' => 'ACa45d8c5ad593278d02f4055907389645',
            'token' => 'f7ed4cc8bbe6e0833e296448d789957c',
            'from' => '+16075233978',
            'site_url' => 'twilio.com'
        ],
        // Install: composer require mediaburst/clockworksms
        'clockwork' => [
            'key' => 'Your clockwork API Key',
            'site_url' => 'https://www.programmableweb.com/api/clockwork-sms'
        ],
        'linkmobility' => [
            'url' => 'http://simple.pswin.com', // Country Wise this may change.
            'username' => 'Your Username',
            'password' => 'Your Password',
            'sender' => 'Sender name',
            'site_url' => 'http://simple.pswin.com'
        ],
        // Install: composer require melipayamak/php
        'melipayamak' => [
            'username' => 'Your Username',
            'password' => 'Your Password',
            'from' => 'Your Default From Number',
            'flash' => false,
            'site_url' => 'melipayamak.com'
        ],
        // Install: composer require kavenegar/php
        'kavenegar' => [
            'apiKey' => 'Your Api Key',
            'from' => 'Your Default From Number',
            'site_url' => 'kavenegar.com'
        ],
        'smsir' => [
            'url' => 'https://ws.sms.ir/',
            'apiKey' => 'Your Api Key',
            'secretKey' => 'Your Secret Key',
            'from' => 'Your Default From Number',
            'site_url' => 'https://sms.ir/'
        ],
        'tsms' => [
            'url' => 'http://www.tsms.ir/soapWSDL/?wsdl',
            'username' => 'Your Username',
            'password' => 'Your Password',
            'from' => 'Your Default From Number',
            'site_url' => 'http://www.tsms.ir'
        ],
        'farazsms' => [
            'url' => '188.0.240.110/services.jspd',
            'username' => 'Your Username',
            'password' => 'Your Password',
            'from' => 'Your Default From Number',
            'site_url' => 'http://188.0.240.110/'
        ],
        'smsgatewayme' => [
            'apiToken' => 'Your Api Token',
            'from' => 'Your Default Device ID',
            'site_url' => 'https://smsgateway.me/'
        ],
        'smsgateway24' => [
            'url' => 'https://smsgateway24.com/getdata/addsms',
            'token' => 'Your Api Token',
            'deviceid' => 'Your Default Device ID',
            'sim' => 'Device SIM Slot.  0 or 1',
            'site_url' => 'https://smsgateway24.com/'
        ],
        'ghasedak' => [
            'url' => 'http://api.iransmsservice.com',
            'apiKey' => 'Your api key',
            'from' => 'Your Default From Number',
            'site_url' => 'http://api.iransmsservice.com'
        ],
        // Install: composer require sms77/api
        'sms77' => [
            'apiKey' => 'Your API Key',
            'flash' => false,
            'from' => 'Sender name',
            'site_url' => 'https://www.sms77.io'
        ],
        'sabapayamak' => [
            'url' => 'https://api.SabaPayamak.com',
            'username' => 'Your Sabapayamak Username',
            'password' => 'Your Sabapayamak Password',
            'from' => 'Your Default From Number',
            'token_valid_day' => 30,
            'site_url' => 'https://api.SabaPayamak.com'
        ],

        'telesign' => [
            'customer_id' => 'Your customer id',
            'api_key' => 'your api key',
            'from' => 'Your Default From Number from your gateway',
            'site_url' => 'https://portal.telesign.com'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Drivers above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use for
    | here with the same name. You will have to extend
    | Tzsk\Sms\Abstracts\Driver in your driver.
    |
    */
    'map' => [
        'sns' => \Tzsk\Sms\Drivers\Sns::class,
        'textlocal' => \Tzsk\Sms\Drivers\Textlocal::class,
        'twilio' => \Tzsk\Sms\Drivers\Twilio::class,
        'smsgateway24' => \Tzsk\Sms\Drivers\SmsGateway24::class,
        'clockwork' => \Tzsk\Sms\Drivers\Clockwork::class,
        'linkmobility' => \Tzsk\Sms\Drivers\Linkmobility::class,
        'melipayamak' => \Tzsk\Sms\Drivers\Melipayamak::class,
        'kavenegar' => \Tzsk\Sms\Drivers\Kavenegar::class,
        'smsir' => \Tzsk\Sms\Drivers\Smsir::class,
        'tsms' => \Tzsk\Sms\Drivers\Tsms::class,
        'farazsms' => \Tzsk\Sms\Drivers\Farazsms::class,
        'ghasedak' => \Tzsk\Sms\Drivers\Ghasedak::class,
        'sms77' => \Tzsk\Sms\Drivers\Sms77::class,
        'sabapayamak' => \Tzsk\Sms\Drivers\SabaPayamak::class,
        'telesign' => \App\Drivers\Telesign::class,
    ],




];
