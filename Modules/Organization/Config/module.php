<?php

use \App\Models\Module;

return [
    'name' => 'Organization',
    'url' => 'organization',
    'scope' => json_encode([Module::SCOPE_ADMIN, Module::SCOPE_COMPANY]),
    'icon' => 'fa fa-building-o',
    'status' => 1,
    'order' => 4,

    //Submodules
    'submodules' => [
        [
            'name' => 'Departments',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Department',
                    'url' => 'organization/department/add',
                    'action' => 'organization.department.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Departments',
                    'url' => 'organization/departments',
                    'action' => 'organization.departments',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Department',
                    'url' => 'organization/department/edit',
                    'action' => 'organization.department.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Department',
                    'url' => 'organization/department/trash',
                    'action' => 'organization.department.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Department',
                    'url' => 'organization/department/restore',
                    'action' => 'organization.department.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Department',
                    'url' => 'organization/department/delete',
                    'action' => 'organization.department.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Designations',
            'show' => 0,
            'order' => 2,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Designation',
                    'url' => 'organization/designation/add',
                    'action' => 'organization.designation.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Designations',
                    'url' => 'organization/designations',
                    'action' => 'organization.designations',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Designation',
                    'url' => 'organization/designation/edit',
                    'action' => 'organization.designation.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Designation',
                    'url' => 'organization/designation/trash',
                    'action' => 'organization.designation.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Designation',
                    'url' => 'organization/designation/restore',
                    'action' => 'organization.designation.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Designation',
                    'url' => 'organization/designation/delete',
                    'action' => 'organization.designation.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Attendance Deduction Policy',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 3,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Deduction Policy',
                    'url' => 'organization/deduction-policy/add',
                    'action' => 'organization.deductionPolicy.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Attendance Deduction Policy',
                    'url' => 'organization/deduction-policies',
                    'action' => 'organization.deductionPolicies',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Deduction Policy',
                    'url' => 'organization/deduction-policy/edit',
                    'action' => 'organization.deductionPolicy.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Deduction Policy',
                    'url' => 'organization/deduction-policy/trash',
                    'action' => 'organization.deductionPolicy.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Deduction Policy',
                    'url' => 'organization/deduction-policy/restore',
                    'action' => 'organization.deductionPolicy.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Deduction Policy',
                    'url' => 'organization/deduction-policy/delete',
                    'action' => 'organization.deductionPolicy.delete',
                    'show' => 0,
                ],
            ],
        ],

        //Leave Policy
        [
            'name' => 'Leave Policy',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 3,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Leave Policy',
                    'url' => 'organization/leave-policy/add',
                    'action' => 'organization.leavePolicy.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Leave Policy',
                    'url' => 'organization/leave-policies',
                    'action' => 'organization.leavePolicies',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Leave Policy',
                    'url' => 'organization/leave-policy/edit',
                    'action' => 'organization.leavePolicy.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Leave Policy',
                    'url' => 'organization/leave-policy/trash',
                    'action' => 'organization.leavePolicy.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Leave Policy',
                    'url' => 'organization/leave-policy/restore',
                    'action' => 'organization.leavePolicy.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Leave Policy',
                    'url' => 'organization/leave-policy/delete',
                    'action' => 'organization.leavePolicy.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],
];
