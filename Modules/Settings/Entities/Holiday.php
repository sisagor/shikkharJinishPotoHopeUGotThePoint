<?php

namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Holiday extends RootModel
{

    use SoftDeletes;

    protected $table = 'holidays';

    protected $fillable = ['id', 'com_id', 'branch_id', 'start_date', 'end_date', 'days', 'occasion', 'holiday_date', 'holiday_year', 'holiday_month', 'status'];


    public static $fetch = ['id', 'com_id', 'occasion', 'start_date', 'end_date', 'days', 'holiday_year', 'holiday_month', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

}
