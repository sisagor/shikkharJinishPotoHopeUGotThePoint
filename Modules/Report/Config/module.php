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
                    'url' => 'reports/attendance',
                    'action' => 'reports.attendance',
                    'show' => 1,
                ],
                [
                    'name' => 'Attendance month wise',
                    'url' => 'reports/attendance-month-wise',
                    'action' => 'reports.attendanceMonthWise',
                    'show' => 1,
                ],
                [
                    'name' => 'Salary Report',
                    'url' => 'reports/salary',
                    'action' => 'reports.salary',
                    'show' => 1,
                ],

                [
                    'name' => 'leave Report',
                    'url' => 'reports/leave',
                    'action' => 'reports.leave',
                    'show' => 1,
                ],

            ],
        ],

    ],

];
