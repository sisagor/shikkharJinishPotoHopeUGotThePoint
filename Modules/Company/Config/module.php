<?php

use \App\Models\Module;

return [
    'name' => 'Branches',
    'url' => 'branch',
    'scope' => json_encode([Module::SCOPE_ADMIN]),
    'icon' => 'fa fa-dropbox',
    'order' => 2,
    'status' => 1,
    'submodules' => [
        [
            'name' => 'Branches',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_ADMIN]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Branches',
                    'url' => 'branch/branches',
                    'action' => 'branch.branches',
                    'show' => 1,
                ],
                [
                    'name' => 'New Branch',
                    'url' => 'branch/branch/add',
                    'action' => 'branch.branch.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit Branch',
                    'url' => 'branch/branch/edit',
                    'action' => 'branch.branch.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Export Branch',
                    'url' => 'branch/branch/export',
                    'action' => 'branch.branch.export',
                    'show' => 0,
                ],
                [
                    'name' => 'View Branch',
                    'url' => 'branch/branch/view',
                    'action' => 'branch.branch.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Branch',
                    'url' => 'branch/branch/trash',
                    'action' => 'branch.branch.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Branch',
                    'url' => 'branch/branch/restore',
                    'action' => 'branch.branch.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Branch',
                    'url' => 'branch/branch/delete',
                    'action' => 'branch.branch.delete',
                    'show' => 0,
                ],
            ],
        ],

    ],

];
