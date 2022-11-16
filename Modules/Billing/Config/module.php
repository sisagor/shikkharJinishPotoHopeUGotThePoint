<?php

use \App\Models\Module;

return [
    'name' => 'Billing',
    'url' => 'billing',
    'scope' => json_encode([Module::SCOPE_COMMON]),
    'icon' => 'fa fa-file',
    'order' => 10,
    'status' => 1,
    'submodules' => [
        [
            'name' => 'Project',
            'show' => 0,
            'order' => 1,
            'status' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'menu' => [
                [
                    'name' => 'New Project',
                    'url' => 'billing/project/add',
                    'action' => 'billing.project.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit Project',
                    'url' => 'billing/project/edit',
                    'action' => 'billing.project.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Projects',
                    'url' => 'billing/projects',
                    'action' => 'billing.projects',
                    'show' => 1,
                ],
                [
                    'name' => 'Trash project',
                    'url' => 'billing/project/trash',
                    'action' => 'billing.project.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore project',
                    'url' => 'billing/project/restore',
                    'action' => 'billing.project.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete project',
                    'url' => 'billing/project/delete',
                    'action' => 'billing.project.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Billing',
            'show' => 0,
            'order' => 2,
            'status' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'menu' => [
                [
                    'name' => 'New Bill',
                    'url' => 'billing/bill/add',
                    'action' => 'billing.bill.add',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Bill',
                    'url' => 'billing/bill/edit',
                    'action' => 'billing.bill.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Approve Bill',
                    'url' => 'billing/bill/approve',
                    'action' => 'billing.bill.approve',
                    'show' => 0,
                ],
                [
                    'name' => 'Pending Bill',
                    'url' => 'billing/bill/pending',
                    'action' => 'billing.bill.pending',
                    'show' => 1,
                ],
                [
                    'name' => 'Approved Bill',
                    'url' => 'billing/bill/approved',
                    'action' => 'billing.bill.approved',
                    'show' => 1,
                ],
                [
                    'name' => 'View Bill',
                    'url' => 'billing/bill/view',
                    'action' => 'billing.bill.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Export Bill',
                    'url' => 'billing/bill/export',
                    'action' => 'billing.bill.export',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Bill',
                    'url' => 'billing/bill/trash',
                    'action' => 'billing.bill.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Bill',
                    'url' => 'billing/bill/restore',
                    'action' => 'billing.bill.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Bill',
                    'url' => 'billing/bill/delete',
                    'action' => 'billing.bill.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],
];
