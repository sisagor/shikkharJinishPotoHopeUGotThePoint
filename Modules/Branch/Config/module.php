<?php

use \App\Models\Module;

return [
    'name' => 'Branch',
    'url' => 'branch',
    'scope' => json_encode([Module::SCOPE_COMPANY]),
    'icon' => 'fa fa-list',
    'order' => 3,
    'status' => 1,
    'submodules' => [
        [
            'name' => 'Branches',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Branches',
                    'url' => 'branches',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'New Branch',
                    'url' => 'branch/add',
                    'action' => 'add',
                    'show' => 0,
                    'order' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Edit Branch',
                    'url' => 'branch/edit',
                    'action' => 'edit',
                    'show' => 0,
                    'order' => 3,
                    'status' => 1,
                ],
                [
                    'name' => 'Export Branch',
                    'url' => 'branch/export',
                    'action' => 'export',
                    'show' => 0,
                    'order' => 5,
                    'status' => 1,
                ],
                [
                    'name' => 'View Branch',
                    'url' => 'branch/view',
                    'action' => 'view',
                    'order' => 6,
                    'show' => 0,
                    'status' => 1,
                ],
                [
                    'name' => 'Trash Branch',
                    'url' => 'branch/trash',
                    'action' => 'trash',
                    'show' => 0,
                    'order' => 7,
                    'status' => 1,
                ],
                [
                    'name' => 'Restore Branch',
                    'url' => 'branch/restore',
                    'action' => 'restore',
                    'show' => 0,
                    'order' => 8,
                    'status' => 1,
                ],
                [
                    'name' => 'Delete Branch',
                    'url' => 'branch/delete',
                    'action' => 'delete',
                    'show' => 0,
                    'order' => 9,
                    'status' => 1,
                ],
            ],
        ],

    ],

];
