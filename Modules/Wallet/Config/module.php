<?php

use \App\Models\Module;

return [
    'name' => 'Wallet',
    'url' => 'wallet',
    'scope' => json_encode([Module::SCOPE_ADMIN, Module::SCOPE_COMPANY]),
    'icon' => 'fa fa-dollar',
    'status' => 1,
    'order' => 8,

    //Submodules
    'submodules' => [
        [
            'name' => 'Wallet',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_ADMIN, Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'wallet',
                    'url' => 'wallet/wallet',
                    'action' => 'wallet.wallet',
                    'show' => 1,
                ],
            ],
        ],

        [
            'name' => 'Transactions',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_ADMIN, Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'transactions',
                    'url' => 'wallet/transactions',
                    'action' => 'wallet.transactions',
                    'show' => 1,
                ],
                [
                    'name' => 'New Transactions',
                    'url' => 'wallet/transaction/add',
                    'action' => 'wallet.transaction.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Transactions',
                    'url' => 'wallet/transaction/delete',
                    'action' => 'wallet.transaction.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],

];
