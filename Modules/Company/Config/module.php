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
                    'url' => 'company/companies',
                    'action' => 'company.companies',
                    'show' => 1,
                ],
                [
                    'name' => 'New Company',
                    'url' => 'company/company/add',
                    'action' => 'company.company.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit Company',
                    'url' => 'company/company/edit',
                    'action' => 'company.company.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Export Company',
                    'url' => 'company/company/export',
                    'action' => 'company.company.export',
                    'show' => 0,
                ],
                [
                    'name' => 'View Company',
                    'url' => 'company/company/view',
                    'action' => 'company.company.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Company',
                    'url' => 'company/company/trash',
                    'action' => 'company.company.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Company',
                    'url' => 'company/company/restore',
                    'action' => 'company.company.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Company',
                    'url' => 'company/company/delete',
                    'action' => 'company.company.delete',
                    'show' => 0,
                ],
            ],
        ],

    ],

];
