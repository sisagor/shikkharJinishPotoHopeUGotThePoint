<?php

namespace Modules\Organization\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;

class DeductionPolicy extends RootModel
{
    use SoftDeletes;

    const TYPE_DAY = "Day";
    const TYPE_HOUR = "Hour";

    protected $table = 'attendance_deduction_policies';

    protected $fillable = ['id', 'com_id', 'type', 'absent', 'deduction_amount', 'is_percent', 'details', 'status'];

    public static $fecth = [
        'id', 'com_id', 'type', 'absent', 'deduction_amount', 'is_percent', 'details', 'status'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

}
