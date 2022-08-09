<?php

namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Recruitment\Entities\Job;


class JobCategory extends RootModel
{
    use SoftDeletes;

    protected $table = 'job_categories';

    protected $fillable = [
        'id', 'com_id', 'name', 'details', 'status'
    ];

    public static $fetch = [
        'id', 'com_id', 'name', 'details', 'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_id', 'id');
    }


}

