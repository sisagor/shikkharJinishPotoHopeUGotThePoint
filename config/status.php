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

    'status' => [
        \App\Models\RootModel::STATUS_ACTIVE => 'Active',
        \App\Models\RootModel::STATUS_INACTIVE => 'Inactive',
    ]


];
