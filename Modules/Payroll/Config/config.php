<?php

use Modules\Payroll\Entities\Salary;
use Modules\Payroll\Entities\SalaryStructure;


return [
    'name' => 'Payroll',

    'salary_structure_types' => [
        SalaryStructure::TYPE_ADD,
        SalaryStructure::TYPE_DEDUCT,
        //SalaryStructure::TYPE_PROVIDENT,
        //SalaryStructure::TYPE_INSURANCE,
        SalaryStructure::TYPE_OVERTIME,
    ],

    'increment_key' => [
        'increment' => 'increment',
        'efficient_bar' => 'efficient_bar',
    ],

    'amount' => [
        'increment_amount',
        'efficient_bar_amount',
    ],

     'year' => [
        'increment_year' => 6,
        'efficient_bar_year' => 15,
    ],


];
