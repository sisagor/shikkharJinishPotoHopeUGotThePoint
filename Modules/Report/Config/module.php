<?php

use \App\Models\Module;

return [
    'name' => 'Reports',
    'url' => 'reports',
    'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
    'icon' => 'fa fa-history',
    'order' => 15,
    'status' => 1,
    'submodules' => [
        [
            'name' => 'Reports',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Attendance Report',
                    'url' => 'attendance',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Attendance month wise',
                    'url' => 'attendance-month-wise',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Salary Report',
                    'url' => 'salary',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 2,
                    'status' => 1,
                ],

                [
                    'name' => 'leave Report',
                    'url' => 'leave',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'View Report',
                    'url' => 'report/view',
                    'action' => 'view',
                    'order' => 3,
                    'show' => 0,
                    'status' => 1,
                ],

                [
                    'name' => 'Export Report',
                    'url' => 'report/export',
                    'action' => 'export',
                    'order' => 4,
                    'show' => 0,
                    'status' => 1,
                ],

            ],
        ],

    ],

];
