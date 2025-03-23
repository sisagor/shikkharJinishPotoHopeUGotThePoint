<?php
use \App\Models\Role;
return [
    'name' => 'User',

    'belongs_to' => [
        'admin' => 'Admin',
    ],

    #define users level here it will implement to whole role management
    ##determine access level
    'user_levels' => [
        ['name' => 'Admin', 'value' => \App\Models\User::USER_ADMIN],
        ['name' => 'Author', 'value' => \App\Models\User::USER_AUTHOR],
    ],

    #define Role level here it will implement to whole role management
    ##detarmine role level to get role
    'role_levels' => [
        ['name' => 'Admin', 'value' => Role::ROLE_ADMIN],
        ['name' => 'Admin User', 'value' => Role::ROLE_ADMIN_USER],
    ],


];
