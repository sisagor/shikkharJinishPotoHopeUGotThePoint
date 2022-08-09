<?php

use \App\Models\Module;

return [
    'name' => 'Timesheet',
    'url' => 'timesheet',
    'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
    'icon' => 'fa fa-clock-o',
    'status' => 1,
    'order' => 6,
    //Submodules
    'submodules' => [
        //Leave
        [
            'name' => 'Dashboard',
            'show' => 0,
            'order' => 2,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Dashboard',
                    'url' => 'dashboard',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 2,
                    'status' => 1,
                ],

            ],
        ],

        [
            'name' => 'Leave Applications',
            'show' => 1,
            'order' => 3,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Leave Application',
                    'url' => 'leave/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 1,
                    'status' => 1,
                ],

                [
                    'name' => 'Pending Applications',
                    'url' => 'leaves',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Approve Application',
                    'url' => 'leave/approve',
                    'action' => 'leaveApprove',
                    'show' => 0,
                    'order' => 3,
                    'status' => 1,
                ],
                [
                    'name' => 'Approved Applications',
                    'url' => 'leave/approved',
                    'action' => 'listApproved',
                    'show' => 1,
                    'order' => 4,
                    'status' => 1,
                ],
                [
                    'name' => 'Reject Application',
                    'url' => 'leave/reject',
                    'action' => 'leaveReject',
                    'show' => 0,
                    'order' => 5,
                    'status' => 1,
                ],
                [
                    'name' => 'Rejected Applications',
                    'url' => 'leave/rejected',
                    'action' => 'listRejected',
                    'show' => 1,
                    'order' => 6,
                    'status' => 1,
                ],
                [
                    'name' => 'Edit Leave Application',
                    'url' => 'leave/edit',
                    'action' => 'edit',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
                [
                    'name' => 'View Leave Application',
                    'url' => 'leave/view',
                    'action' => 'view',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
                [
                    'name' => 'delete Leave Application',
                    'url' => 'shift/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 8,
                    'status' => 1,
                ],
            ],
        ],

        //Attendance
        [
            'name' => 'Attendance',
            'show' => 1,
            'order' => 4,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Punch',
                    'url' => 'attendance/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Punch Log',
                    'url' => 'punch-log',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Attendances',
                    'url' => 'attendances',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 3,
                    'status' => 1,
                ],

                [
                    'name' => 'Absent',
                    'url' => 'absent',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 4,
                    'status' => 1,
                ],
                [
                    'name' => 'On Leave',
                    'url' => 'on-leave',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 6,
                    'status' => 1,
                ],
                [
                    'name' => 'Edit Attendance',
                    'url' => 'attendance/edit',
                    'action' => 'edit',
                    'show' => 0,
                    'order' => 17,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Attendance',
                    'url' => 'attendance/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 18,
                    'status' => 1,
                ],

                [
                    'name' => 'View Attendance',
                    'url' => 'attendance/view',
                    'action' => 'view',
                    'show' => 0,
                    'order' => 19,
                    'status' => 1,
                ],

                [
                    'name' => 'Export Attendance',
                    'url' => 'attendance/export',
                    'action' => 'export',
                    'show' => 0,
                    'order' => 20,
                    'status' => 1,
                ],
            ],
        ],

    ],

];
