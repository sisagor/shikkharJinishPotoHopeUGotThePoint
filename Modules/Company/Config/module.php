<?php

use \App\Models\Module;

return [
    'name' => 'Company',
    'url' => 'company',
    'scope' => json_encode([Module::SCOPE_ADMIN]),
    'icon' => 'fa fa-dropbox',
    'order' => 2,
    'status' => 1,
    'submodules' => [
        [
            'name' => 'Companies',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_ADMIN]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'companies',
                    'url' => 'companies',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'New Company',
                    'url' => 'company/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Edit Company',
                    'url' => 'company/edit',
                    'action' => 'edit',
                    'show' => 0,
                    'order' => 3,
                    'status' => 1,
                ],
                [
                    'name' => 'Export Company',
                    'url' => 'company/export',
                    'action' => 'export',
                    'show' => 0,
                    'order' => 5,
                    'status' => 1,
                ],
                [
                    'name' => 'View Company',
                    'url' => 'company/view',
                    'action' => 'view',
                    'order' => 6,
                    'show' => 0,
                    'status' => 1,
                ],
                [
                    'name' => 'Trash Company',
                    'url' => 'company/trash',
                    'action' => 'trash',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
                [
                    'name' => 'Restore Company',
                    'url' => 'company/restore',
                    'action' => 'restore',
                    'show' => 0,
                    'order' => 8,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Company',
                    'url' => 'company/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 9,
                    'status' => 1,
                ],
            ],
        ],

    ],

];
