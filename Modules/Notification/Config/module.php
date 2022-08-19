<?php

use \App\Models\Module;

return [
    'name' => 'Notification',
    'url' => 'notification',
    'scope' => json_encode([Module::SCOPE_COMMON]),
    'icon' => 'fa fa-bell-o',
    'order' => 10,
    'status' => 1,
    'submodules' => [
        [
            'name' => 'SMS',
            'show' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Schedule Sms',
                    'url' => 'notification/sms/schedule/add',
                    'action' => 'notification.sms.schedule.add',
                    'show' => 1,
                ],
                [
                    'name' => 'Sms Log',
                    'url' => 'notification/sms/logs',
                    'action' => 'notification.sms.logs',
                    'show' => 1,
                ],
                [
                    'name' => 'Send Sms',
                    'url' => 'notification/sms/add',
                    'action' => 'notification.sms.add',
                    'show' => 0,
                ],
                [
                    'name' => 'View SMS',
                    'url' => 'notification/sms/view',
                    'action' => 'notification.sms.view',
                    'show' => 0,
                    'order' => 6,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Sms log',
                    'url' => 'notification/sms/delete',
                    'action' => 'notification.sms.delete',
                    'show' => 0,
                    'order' => 4,
                    'status' => 1,
                ],
            ],
        ],

        [
            'name' => 'Emails',
            'show' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Schedule Email',
                    'url' => 'notification/email/schedule/add',
                    'action' => 'notification.emails.schedule.add',
                    'show' => 1,
                ],
                [
                    'name' => 'Emails Sent Log',
                    'url' => 'notification/email/logs',
                    'action' => 'notification.emails.logs',
                    'show' => 1,
                ],
                [
                    'name' => 'Send Email',
                    'url' => 'notification/email/add',
                    'action' => 'notification.emails.add',
                    'show' => 0,
                ],
                [
                    'name' => 'View Email',
                    'url' => 'notification/email/view',
                    'action' => 'notification.emails.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Email',
                    'url' => 'notification/email/delete',
                    'action' => 'notification.emails.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],

];
