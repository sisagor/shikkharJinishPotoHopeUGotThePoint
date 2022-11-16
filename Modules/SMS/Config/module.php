<?php

use \App\Models\Module;

return [
    'name' => 'SMS',
    'url' => 'sms',
    'scope' => json_encode([Module::SCOPE_COMMON]),
    'icon' => 'fa fa-envelope-o',
    'order' => 10,
    'status' => 1,
    'submodules' => [
        [
            'name' => 'SMS',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Sms Log',
                    'url' => 'sms-log',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Send Sms',
                    'url' => 'sms/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Sms log',
                    'url' => 'sms/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 4,
                    'status' => 1,
                ],
            ],
        ],

        [
            'name' => 'Emails',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 1,
            'status' => 0,
            'menu' => [
                [
                    'name' => 'Emails',
                    'url' => 'emails',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Send Email',
                    'url' => 'email/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'View Email',
                    'url' => 'email/view',
                    'action' => 'view',
                    'show' => 0,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Email',
                    'url' => 'email/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 4,
                    'status' => 1,
                ],
            ],
        ],

    ],

];
