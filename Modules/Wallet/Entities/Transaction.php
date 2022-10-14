<?php

namespace Modules\Wallet\Entities;

use App\Models\User;
use App\Models\RootModel;
use Modules\Employee\Entities\Employee;

class Transaction extends RootModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * fallible property
     */

    protected $table = "transactions";

    public const TYPE_WELFARE = "welfare";
    public const TYPE_LOAN = "loan";
    public const TYPE_INSTALLMENT = "installment";
    public const TYPE_SALARY_ADVANCE = "salary_advance";
    public const TYPE_COMPANY_PF = "company_pf";
    public const TYPE_EMPLOYEE_PF = "employee_pf";
    public const TYPE_GRATUITY = "gratuity";


    //Fallible;
    protected $fillable = ['id', 'employee_id', 'trx_id', 'trx_date', 'title', 'details', 'debit', 'credit', 'created_by'];

    //Fetching filled;
    public static $fetch = ['id', 'employee_id', 'trx_id', 'trx_date', 'title', 'details', 'debit', 'credit', 'created_by'];


    //user
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    //employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

}
