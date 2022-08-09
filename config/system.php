<?php
/*
|--------------------------------------------------------------------------
| System configs
|--------------------------------------------------------------------------
|
| The application needs this config file to run properly.
| Don't change any value is you're not sure about it.
|
*/
return [

    'database' => env('DB_DATABASE'),

    /*
    |--------------------------------------------------------------------------
    | Use Cache
    |--------------------------------------------------------------------------
    |
    | Config values for cache.
    | if yes you need to config cache credentials
    */
    'use_cache' => env('USE_CACHE', true),


    /*
    |--------------------------------------------------------------------------
    | CSV Import Limit
    |--------------------------------------------------------------------------
    |
    | This much records can be uploaded in a single batch in csv upload inventories/products
    |
    */
    'csv_import_limit' => 50,

    /*
    |--------------------------------------------------------------------------
    | Import Required
    |--------------------------------------------------------------------------
    |
    | This fields are required to csv upload
    |
    */
    'import_required' => [],

    /*
    |--------------------------------------------------------------------------
    | Notification limit
    |--------------------------------------------------------------------------
    |
    */

    'notification_limit' => 10,

];
