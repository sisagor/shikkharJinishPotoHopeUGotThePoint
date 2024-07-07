<?php

namespace Modules\Organization\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Modules\Settings\Entities\LeaveType;

class LeavePolicy extends RootModel
{
    use SoftDeletes;

    const APPLY_AFTER_JOINING = "joining_date";
    const APPLY_AFTER_PROVISION = "after_provision";


    protected $table = 'leave_policies';

    protected $fillable = ['id', 'com_id', 'type_id', 'name', 'apply_at', 'details', 'status'];

    public static $fecth = ['id', 'com_id', 'type_id', 'name', 'apply_at', 'details', 'status'];


    protected $casts = [
        'type_id' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'leave_policy_id', 'id');
    }

    public function getTypeIdAttribute($value)
    {
        if (empty($value)){
            return [];
        }
        // if using casts to array, this should already be done
        $scores =  json_decode(json_decode($value), true);
        //$scores = (is_string($scores) ? explode(',', $scores) : $scores);

        return LeaveType::whereIn('id', array_values($scores))->select('id', 'name', 'days')->get();
    }

}
