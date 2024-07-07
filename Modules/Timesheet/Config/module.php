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
                    'url' => 'timesheet/dashboard',
                    'action' => 'timesheet.dashboard',
                    'show' => 1,
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
                    'url' => 'timesheet/leave/add',
                    'action' => 'timesheet.leave.add',
                    'show' => 0,
                ],

                [
                    'name' => 'Pending Applications',
                    'url' => 'timesheet/leaves',
                    'action' => 'timesheet.leaves',
                    'show' => 1,
                ],
                [
                    'name' => 'Approve Application',
                    'url' => 'timesheet/leave/approve',
                    'action' => 'timesheet.leave.approve',
                    'show' => 0,
                ],
                [
                    'name' => 'Approved Applications',
                    'url' => 'timesheet/leave/approved',
                    'action' => 'timesheet.leave.approved',
                    'show' => 1,
                ],
                [
                    'name' => 'Reject Application',
                    'url' => 'timesheet/leave/reject',
                    'action' => 'timesheet.leave.reject',
                    'show' => 0,
                ],
                [
                    'name' => 'Rejected Applications',
                    'url' => 'timesheet/leave/rejected',
                    'action' => 'timesheet.leave.rejected',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Leave Application',
                    'url' => 'timesheet/leave/edit',
                    'action' => 'timesheet.leave.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'View Leave Application',
                    'url' => 'timesheet/leave/view',
                    'action' => 'timesheet.leave.view',
                    'show' => 0,
                ],
                [
                    'name' => 'delete Leave Application',
                    'url' => 'timesheet/shift/delete',
                    'action' => 'timesheet.leave.delete',
                    'show' => 0,
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
                    'url' => 'timesheet/attendance/add',
                    'action' => 'timesheet.attendance.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Punch Log',
                    'url' => 'timesheet/punch-log',
                    'action' => 'timesheet.attendance.punchLog',
                    'show' => 1,
                ],
                [
                    'name' => 'Attendances',
                    'url' => 'timesheet/attendances',
                    'action' => 'timesheet.attendances',
                    'show' => 1,
                ],

                [
                    'name' => 'Absent',
                    'url' => 'timesheet/absent',
                    'action' => 'timesheet.attendance.absent',
                    'show' => 1,
                ],
                [
                    'name' => 'On Leave',
                    'url' => 'timesheet/on-leave',
                    'action' => 'timesheet.attendance.onLeave',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Attendance',
                    'url' => 'timesheet/attendance/edit',
                    'action' => 'timesheet.attendance.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Attendance',
                    'url' => 'timesheet/attendance/delete',
                    'action' => 'timesheet.attendance.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'View Attendance',
                    'url' => 'timesheet/attendance/view',
                    'action' => 'timesheet.attendance.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Export Attendance',
                    'url' => 'timesheet/attendance/export',
                    'action' => 'timesheet.attendance.export',
                    'show' => 0,
                ],
            ],
        ],

    ],

];
