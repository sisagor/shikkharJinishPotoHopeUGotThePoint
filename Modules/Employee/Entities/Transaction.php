<?php

namespace Modules\Wallet\Entities;

use App\Models\User;
use App\Models\RootModel;


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

    protected $fillable = ['id', 'employee_id', 'trx_id', 'trx_date', 'title', 'details', 'debit', 'credit'];

    public static $fetch = ['id', 'employee_id', 'trx_id', 'trx_date', 'title', 'details', 'debit', 'credit'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
