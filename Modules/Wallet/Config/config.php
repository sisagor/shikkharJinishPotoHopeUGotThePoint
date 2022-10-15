<?php
use  \Modules\Wallet\Entities\Transaction;

return [
    'name' => 'Wallet',

    'type' => [
        Transaction::TYPE_LOAN           => "Loan",
        Transaction::TYPE_INSTALLMENT    => "Installment",
        Transaction::TYPE_WELFARE        => "Welfare",
        Transaction::TYPE_GRATUITY       => "Gratuity",
        Transaction::TYPE_COMPANY_PF     => "Company PF",
        Transaction::TYPE_EMPLOYEE_PF    => "Employee PF",
        Transaction::TYPE_SALARY_ADVANCE => "Salary Advance",
    ]
];
