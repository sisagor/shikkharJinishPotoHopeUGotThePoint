<?php

use \App\Models\Module;

return [
    'name' => 'Loans / Advance salary',
    'url' => 'loanss',
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
                    'url' => 'loans/loan/add',
                    'action' => 'loans.loan.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Pending Loans',
                    'url' => 'loans/loan/pending',
                    'action' => 'loans.loan.pending',
                    'show' => 1,
                ],
                [
                    'name' => 'Approved Loans',
                    'url' => 'loans/loan/approved',
                    'action' => 'loans.loan.approved',
                    'show' => 1,
                ],
                [
                    'name' => 'Released Loans',
                    'url' => 'loans/loan/released',
                    'action' => 'loans.loan.released',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Loan',
                    'url' => 'loans/loan/edit',
                    'action' => 'loans.loan.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Approve Loan',
                    'url' => 'loans/loan/approve',
                    'action' => 'loans.loan.approve',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Loan',
                    'url' => 'loans/loan/delete',
                    'action' => 'loans.loan.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Loan',
                    'url' => 'loans/loan/trash',
                    'action' => 'loans.loan.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Loan',
                    'url' => 'loans/loan/restore',
                    'action' => 'loans.loan.restore',
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
                    'url' => 'loans/installments/add',
                    'action' => 'loans.installments.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Installments',
                    'url' => 'loans/installments',
                    'action' => 'loans.installments',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Installments',
                    'url' => 'loans/installments/edit',
                    'action' => 'loans.installments.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Installments',
                    'url' => 'loans/installments/delete',
                    'action' => 'loans.installments.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],

];
