<?php

namespace Modules\Settings\Entities;


use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;


class EmployeeType extends RootModel
{

    use SoftDeletes;

    const COMPANY_FACILITY_ALLOW = 1;
    const COMPANY_FACILITY_NOT_ALLOW = 0;

    protected $table = 'employee_types';

    protected $fillable = [
        'id', 'com_id', 'name', 'allow_company_facility', 'details', 'status'
    ];

    public static $fetch = ['id', 'com_id', 'name', 'allow_company_facility', 'details', 'status'];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'type_id', 'id');
    }

}
