<?php

use \App\Models\Module;

return [
    'name' => 'Payroll',
    'url' => 'payroll',
    'scope' => json_encode([Module::SCOPE_ADMIN, Module::SCOPE_COMPANY]),
    'icon' => 'fa fa-credit-card-alt',
    'status' => 1,
    'order' => 7,

    //Submodules
    'submodules' => [
        [
            'name' => 'Salary Structure Components',
            'show' => 0,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 2,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Component',
                    'url' => 'payroll/structure/add',
                    'action' => 'payroll.structure.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Salary Structure Components',
                    'url' => 'payroll/structures',
                    'action' => 'payroll.structures',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Salary Structure Component',
                    'url' => 'payroll/structure/edit',
                    'action' => 'payroll.structure.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Salary Structure Components',
                    'url' => 'payroll/structure/trash',
                    'action' => 'payroll.structure.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Salary Structure Components',
                    'url' => 'payroll/structure/restore',
                    'action' => 'payroll.structure.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Salary Structure Components',
                    'url' => 'payroll/structure/delete',
                    'action' => 'payroll.structure.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Salary Rules',
            'show' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 3,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Salary Rule',
                    'url' => 'payroll/rule/add',
                    'action' => 'payroll.rule.add',
                    'show' => 1,
                ],
                [
                    'name' => 'Salary Rules',
                    'url' => 'payroll/rules',
                    'action' => 'payroll.rules',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Salary Rule',
                    'url' => 'payroll/rule/edit',
                    'action' => 'payroll.rule.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'View Salary Rule',
                    'url' => 'payroll/rule/view',
                    'action' => 'payroll.rule.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash Salary Rule',
                    'url' => 'payroll/rule/trash',
                    'action' => 'payroll.rule.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore Salary Rule',
                    'url' => 'payroll/rule/restore',
                    'action' => 'payroll.rule.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Salary Rule',
                    'url' => 'payroll/rule/delete',
                    'action' => 'payroll.rule.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Salary',
            'show' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'order' => 4,
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Generate Salary',
                    'url' => 'payroll/salary-generate',
                    'action' => 'payroll.salaryGenerate',
                    'show' => 0,
                ],
                [
                    'name' => 'Pending Salaries',
                    'url' => 'payroll/pending-salaries',
                    'action' => 'payroll.pendingSalaries',
                    'show' => 1,
                ],
                [
                    'name' => 'Approved Salaries',
                    'url' => 'payroll/approved-salaries',
                    'action' => 'payroll.approvedSalaries',
                    'show' => 1,
                ],
                [
                    'name' => 'Salary Approve',
                    'url' => 'payroll/salary/approve',
                    'action' => 'payroll.salary.approve',
                    'show' => 0,
                ],
                [
                    'name' => 'Salary Pay',
                    'url' => 'payroll/salary/pay',
                    'action' => 'payroll.salary.pay',
                    'show' => 0,
                ],
                [
                    'name' => 'Salary Payslip',
                    'url' => 'payroll/salary/payslip',
                    'action' => 'payroll.salary.payslip',
                    'show' => 0,
                ],
                [
                    'name' => 'Payslip Print',
                    'url' => 'payroll/salary/payslip/print',
                    'action' => 'payroll.salary.payslip.print',
                    'show' => 0,
                ],
                [
                    'name' => 'View Salary',
                    'url' => 'payroll/salary/view',
                    'action' => 'payroll.salary.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Salary',
                    'url' => 'payroll/salary/delete',
                    'action' => 'payroll.salary.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],
];
