<?php

namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;

class Shift extends RootModel
{
    use SoftDeletes;

    protected $table = 'shifts';

    protected $fillable = ['id', 'com_id', 'name', 'start_time', 'end_time', 'working_hour', 'details', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'shift_id', 'id');
    }

}
