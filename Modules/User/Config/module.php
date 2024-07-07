<?php

use \App\Models\Module;

return [
    'name' => 'User Management',
    'url' => 'user-managements',
    'scope' => json_encode([Module::SCOPE_COMPANY, Module::SCOPE_ADMIN]),
    'icon' => 'fa fa-users',
    'status' => 1,
    'order' => 1,
    //Submodules
    'submodules' => [
        [
            'name' => 'Roles',
            'show' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 1,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Roles',
                    'url' => 'user-managements/roles',
                    'action' => 'userManagements.roles',
                    'show' => 1,
                ],
                [
                    'name' => 'New Role',
                    'url' => 'user-managements/role/add',
                    'action' => 'userManagements.role.add',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Role',
                    'url' => 'user-managements/role/edit',
                    'action' => 'userManagements.role.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Role',
                    'url' => 'user-managements/role/trash',
                    'action' => 'userManagements.role.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Role',
                    'url' => 'user-managements/role/restore',
                    'action' => 'userManagements.role.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Role',
                    'url' => 'user-managements/role/delete',
                    'action' => 'userManagements.role.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Users',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 2,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Users',
                    'url' => 'user-managements/users',
                    'action' => 'userManagements.users',
                    'show' => 1,
                ],
                [
                    'name' => 'New User',
                    'url' => 'user-managements/user/add',
                    'action' => 'userManagements.user.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit User',
                    'url' => 'user-managements/user/edit',
                    'action' => 'userManagements.user.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'View User',
                    'url' => 'user-managements/user/view',
                    'action' => 'userManagements.user.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash User',
                    'url' => 'user-managements/user/trash',
                    'action' => 'userManagements.user.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore User',
                    'url' => 'user-managements/user/restore',
                    'action' => 'userManagements.user.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete User',
                    'url' => 'user-managements/user/delete',
                    'action' => 'userManagements.user.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'Export User',
                    'url' => 'user-managements/user/export',
                    'action' => 'userManagements.user.export',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Password Reset',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 3,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Password Reset',
                    'url' => 'user-managements/user/password-reset',
                    'action' => 'userManagements.user.passwordReset',
                    'show' => 1,
                ],
            ],
        ],
    ],
];
