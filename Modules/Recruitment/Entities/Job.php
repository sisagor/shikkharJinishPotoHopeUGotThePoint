<?php

namespace Modules\Recruitment\Entities;

use App\Models\RootModel;
use App\Common\Documentable;
use App\Common\CascadeSoftDeletes;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Settings\Entities\JobCategory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Job extends RootModel
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $table = 'job_postings';

    const STATUS_OPEN = "open";
    const STATUS_CLOSE = "closed";

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'com_id', 'branch_id', 'category_id', 'position', 'details', 'requirements', 'expire_date', 'experience', 'vacancy', 'status',
        'salary_rang', 'job_location'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id', 'id');
    }

}
