<?php

namespace Modules\Wallet\Entities;

use App\Models\User;
use App\Models\RootModel;
use Modules\Employee\Entities\Employee;

class Wallet extends RootModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * fallible property
     */

    protected $table = "wallets";

    protected $fillable = [
        'id', 'com_id', 'branch_id', 'employee_id', 'company_pf', 'employee_pf', 'gratuity',
        'welfare', 'balance'
    ];

    public static $fetch = [
        'com_id', 'branch_id', 'employee_id', 'company_pf', 'employee_pf', 'gratuity',
        'welfare', 'balance'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }



    /**
     * @return float|int
     */
    public function getAvailableBalance()
    {
        return $this->employee()->sum('amount');
    }


}
