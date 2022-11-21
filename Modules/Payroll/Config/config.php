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


    //Configure pay scales;
    'pay_scale' => [
        'increment_one' => 6,
        'increment_two' => 15,
    ],


];
