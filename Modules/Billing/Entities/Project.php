<?php

namespace Modules\Billing\Entities;


use App\Models\User;
use App\Models\RootModel;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;



class Project extends RootModel {

    use SoftDeletes;
    //table name;
    protected $table = 'projects';

    protected $fillable = [
        'id', 'com_id', 'branch_id', 'manager_id', 'name', 'details', 'status'
    ];

    public static $fetch = [
        'id', 'com_id', 'branch_id', 'manager_id', 'name', 'details', 'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function invoice()
    {
        return $this->hasMany(Billing::class, 'project_id', 'id');
    }

}
