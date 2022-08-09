<?php

use \App\Models\Module;

return [
    'name' => 'Loans / Advance salary',
    'url' => 'loans',
    'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
    'icon' => 'fa fa-credit-card',
    'status' => 0,
    'order' => 8,

    //Submodules
    'submodules' => [
        [
            'name' => 'Loan',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Loan',
                    'url' => 'loan/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Pending Loans',
                    'url' => 'loan/pending',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Approved Loans',
                    'url' => 'loan/approved',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 3,
                    'status' => 1,
                ],
                [
                    'name' => 'Released Loans',
                    'url' => 'loan/released',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 4,
                    'status' => 1,
                ],
                [
                    'name' => 'Edit Loan',
                    'url' => 'loan/edit',
                    'action' => 'edit',
                    'show' => 0,
                    'order' => 5,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Loan',
                    'url' => 'loan/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
                [
                    'name' => 'Trash Loan',
                    'url' => 'loan/trash',
                    'action' => 'trash',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
                [
                    'name' => 'Restore Loan',
                    'url' => 'loan/restore',
                    'action' => 'restore',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
            ],
        ],

        [
            'name' => 'Installments',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Installments',
                    'url' => 'installments/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Installments',
                    'url' => 'installments',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 4,
                    'status' => 1,
                ],
                [
                    'name' => 'Edit Installments',
                    'url' => 'installments/edit',
                    'action' => 'edit',
                    'show' => 0,
                    'order' => 5,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Installments',
                    'url' => 'installments/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
            ],
        ],
    ],

];
