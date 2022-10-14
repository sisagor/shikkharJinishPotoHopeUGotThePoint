<?php

use \App\Models\Module;

return [
    'name' => 'Loans / Advance salary',
    'url' => 'loans',
    'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
    'icon' => 'fa fa-credit-card',
    'status' => 1,
    'order' => 9,

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
                    'url' => 'loan/loan/add',
                    'action' => 'loan.loan.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Pending Loans',
                    'url' => 'loan/loan/pending',
                    'action' => 'loan.loan.pending',
                    'show' => 1,
                ],
                [
                    'name' => 'Approved Loans',
                    'url' => 'loan/loan/approved',
                    'action' => 'loan.loan.approved',
                    'show' => 1,
                ],
                [
                    'name' => 'Released Loans',
                    'url' => 'loan/loan/released',
                    'action' => 'loan.loan.released',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Loan',
                    'url' => 'loan/loan/edit',
                    'action' => 'loan.loan.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Approve Loan',
                    'url' => 'loan/loan/approve',
                    'action' => 'loan.loan.approve',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Loan',
                    'url' => 'loan/loan/delete',
                    'action' => 'loan.loan.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Loan',
                    'url' => 'loan/loan/trash',
                    'action' => 'loan.loan.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Loan',
                    'url' => 'loan/loan/restore',
                    'action' => 'loan.loan.restore',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Installments',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'status' => 0,
            'menu' => [
                [
                    'name' => 'New Installments',
                    'url' => 'loan/installments/add',
                    'action' => 'loan.installments.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Installments',
                    'url' => 'loan/installments',
                    'action' => 'loan.installments',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Installments',
                    'url' => 'loan/installments/edit',
                    'action' => 'loan.installments.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Installments',
                    'url' => 'loan/installments/delete',
                    'action' => 'loan.installments.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],

];
