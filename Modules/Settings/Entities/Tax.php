<?php

namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;

class Tax extends RootModel
{
    use SoftDeletes;
    protected $table = 'taxes';

    protected $fillable = [
        'id', 'com_id', 'eligible_amount', 'tax', 'status'
    ];

    public static $fetch = [
        'id', 'com_id', 'eligible_amount', 'tax', 'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }


}

