<?php

use \App\Models\Module;

return [
    'name' => 'Employee Information',
    'url' => 'employee',
    'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
    'icon' => 'fa fa-user',
    'status' => 1,
    'order' => 5,

    //Submodules
    'submodules' => [
        [
            'name' => 'Employees',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON, Module::SCOPE_EMPLOYEE]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Employee',
                    'url' => 'employee/employee/add',
                    'action' => 'employee.employee.add',
                    'show' => 1,
                ],
                [
                    'name' => 'Employees',
                    'url' => 'employee/employees',
                    'action' => 'employee.employees',
                    'show' => 1,
                ],
                [
                    'name' => 'Inactive Employees',
                    'url' => 'employee/employees/inactive',
                    'action' => 'employee.employees.inactive',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Employment information',
                    'url' => 'employee/employment/edit',
                    'action' => 'employee.employment.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit Personal Information',
                    'url' => 'employee/personal/edit',
                    'action' => 'employee.personal.edit',
                    'show' => 0,
                ],

                [
                    'name' => 'View Employee',
                    'url' => 'employee/employee/view',
                    'action' => 'employee.employee.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Export Employee',
                    'url' => 'employee/employee/export',
                    'action' => 'employee.employee.export',
                    'show' => 0,
                ],
                [
                    'name' => 'Import Employee',
                    'url' => 'employee/employee/import',
                    'action' => 'employee.employee.import',
                    'show' => 0,
                ],

                [
                    'name' => 'Trash Employee',
                    'url' => 'employee/employee/trash',
                    'action' => 'employee.employee.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Employee',
                    'url' => 'employee/employee/restore',
                    'action' => 'employee.employee.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Employee',
                    'url' => 'employee/employee/delete',
                    'action' => 'employee.employee.delete',
                    'show' => 0,
                ],

                //Educations
                [
                    'name' => 'New Education',
                    'url' => 'employee/education/add',
                    'action' => 'employee.education.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Employee Educations',
                    'url' => 'employee/educations',
                    'action' => 'employee.educations',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit Education',
                    'url' => 'employee/education/edit',
                    'action' => 'employee.education.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Approve Education',
                    'url' => 'employee/education/approve',
                    'action' => 'employee.education.approve',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Education',
                    'url' => 'employee/education/delete',
                    'action' => 'employee.education.delete',
                    'show' => 0,
                ],

                //Address
                [
                    'name' => 'New Address',
                    'url' => 'employee/address/add',
                    'action' => 'employee.address.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Employee Addresses',
                    'url' => 'employee/addresses',
                    'action' => 'employee.addresses',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit Address',
                    'url' => 'employee/address/edit',
                    'action' => 'employee.address.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'View Address',
                    'url' => 'employee/address/view',
                    'action' => 'employee.address.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Address',
                    'url' => 'employee/address/delete',
                    'action' => 'employee.address.delete',
                    'show' => 0,
                ],

                //Documents
                [
                    'name' => 'New Document',
                    'url' => 'employee/document/add',
                    'action' => 'employee.document.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Documents',
                    'url' => 'employee/documents',
                    'action' => 'employee.documents',
                    'show' => 0,
                ],
                [
                    'name' => 'Edit Document',
                    'url' => 'employee/document/edit',
                    'action' => 'employee.document.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Document',
                    'url' => 'employee/document/delete',
                    'action' => 'employee.document.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'Export Document',
                    'url' => 'employee/document/export',
                    'action' => 'employee.document.export',
                    'show' => 0,
                ],
                [
                    'name' => 'Approve Document',
                    'url' => 'employee/document/approve',
                    'action' => 'employee.document.approve',
                    'show' => 0,

                ],

                //document end

            ],
        ],
    ],

];
