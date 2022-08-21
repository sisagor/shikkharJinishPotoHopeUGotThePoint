<?php

use \App\Models\Module;

return [
    'name' => 'Component Settings',
    'url' => 'component-settings',
    'scope' => json_encode([Module::SCOPE_COMMON]),
    'icon' => 'fa fa-cog',
    'status' => 1,
    'order' => 0,

    //Submodules
    'submodules' => [
        //Employee Types
        [
            'name' => 'Employment Type',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_ADMIN, Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Employment Type',
                    'url' => 'component-settings/employment-type/add',
                    'action' => 'componentSettings.employmentType.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Employment Types',
                    'url' => 'component-settings/employment-types',
                    'action' => 'componentSettings.employmentTypes',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Employment Type',
                    'url' => 'component-settings/employment-type/edit',
                    'action' => 'componentSettings.employmentType.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Employment Type',
                    'url' => 'component-settings/employment-type/trash',
                    'action' => 'componentSettings.employmentType.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Employment Type',
                    'url' => 'component-settings/employment-type/restore',
                    'action' => 'componentSettings.employmentType.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Employment Type',
                    'url' => 'component-settings/employment-type/delete',
                    'action' => 'componentSettings.employmentType.delete',
                    'show' => 0,
                ],
            ],
        ],

        //leave-types
        [
            'name' => 'Leave Types',
            'show' => 0,
            'order' => 3,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Leave Type',
                    'url' => 'component-settings/leave-type/add',
                    'action' => 'componentSettings.leaveType.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Leave Types',
                    'url' => 'component-settings/leave-types',
                    'action' => 'componentSettings.leaveTypes',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Leave Type',
                    'url' => 'component-settings/leave-type/edit',
                    'action' => 'componentSettings.leaveType.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Leave Type',
                    'url' => 'component-settings/leave-type/trash',
                    'action' => 'componentSettings.leaveType.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Leave Type',
                    'url' => 'component-settings/leave-type/restore',
                    'action' => 'componentSettings.leaveType.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Leave Type',
                    'url' => 'component-settings/leave-type/delete',
                    'action' => 'componentSettings.leaveType.delete',
                    'show' => 0,
                ],
            ],
        ],

        //Tax setting menus
        [
            'name' => 'Taxes',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 4,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Tax',
                    'url' => 'component-settings/tax/add',
                    'action' => 'componentSettings.tax.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Taxes',
                    'url' => 'component-settings/taxes',
                    'action' => 'componentSettings.taxes',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Tax',
                    'url' => 'component-settings/tax/edit',
                    'action' => 'componentSettings.tax.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Tax',
                    'url' => 'component-settings/tax/trash',
                    'action' => 'componentSettings.tax.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Tax',
                    'url' => 'component-settings/tax/restore',
                    'action' => 'componentSettings.tax.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Tax',
                    'url' => 'component-settings/tax/delete',
                    'action' => 'componentSettings.tax.delete',
                    'show' => 0,
                ],
            ],
        ],

        //Shift
        [
            'name' => 'Working Shift',
            'show' => 0,
            'order' => 2,
            'scope' => json_encode([Module::SCOPE_ADMIN, Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Shift',
                    'url' => 'component-settings/shift/add',
                    'action' => 'componentSettings.shift.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Working Shifts',
                    'url' => 'component-settings/shifts',
                    'action' => 'componentSettings.shifts',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Shift',
                    'url' => 'component-settings/shift/edit',
                    'action' => 'componentSettings.shift.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Shift',
                    'url' => 'component-settings/shift/trash',
                    'action' => 'componentSettings.shift.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Shift',
                    'url' => 'component-settings/shift/restore',
                    'action' => 'componentSettings.shift.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Shift',
                    'url' => 'component-settings/shift/delete',
                    'action' => 'componentSettings.shift.delete',
                    'show' => 0,
                ],
            ],
        ],

        //Holidays
        [
            'name' => 'Holidays',
            'show' => 0,
            'order' => 6,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Holiday',
                    'url' => 'component-settings/holiday/add',
                    'action' => 'componentSettings.holiday.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Holidays',
                    'url' => 'component-settings/holidays',
                    'action' => 'componentSettings.holidays',
                    'show' => 1,
                ],
                [
                    'name' => 'Trash Holiday',
                    'url' => 'component-settings/holiday/trash',
                    'action' => 'componentSettings.holiday.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Holiday',
                    'url' => 'component-settings/holiday/restore',
                    'action' => 'componentSettings.holiday.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Holiday',
                    'url' => 'component-settings/holiday/delete',
                    'action' => 'componentSettings.holiday.delete',
                    'show' => 0,
                ],
            ],
        ],

        //Job Categories
        [
            'name' => 'Job Category',
            'show' => 0,
            'order' => 8,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Job Category',
                    'url' => 'component-settings/job-category/add',
                    'action' => 'componentSettings.jobCategory.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Job Categories',
                    'url' => 'component-settings/job-categories',
                    'action' => 'componentSettings.jobCategories',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Category',
                    'url' => 'component-settings/job-category/edit',
                    'action' => 'componentSettings.jobCategory.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'component-settings/job-category/trash',
                    'action' => 'componentSettings.jobCategory.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'component-settings/job-category/restore',
                    'action' => 'componentSettings.jobCategory.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete',
                    'url' => 'component-settings/job-category/delete',
                    'action' => 'componentSettings.jobCategory.delete',
                    'show' => 0,
                ],
            ],
        ],


    ],

];
