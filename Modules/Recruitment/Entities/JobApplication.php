<?php

namespace Modules\Recruitment\Entities;

use App\Models\RootModel;
use App\Common\Documentable;
use App\Common\CascadeSoftDeletes;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Settings\Entities\JobCategory;


class JobApplication extends RootModel
{
    use SoftDeletes, Documentable, CascadeSoftDeletes;

    protected $table = 'job_applications';

    const STATUS_PENDING = "pending";
    const STATUS_REJECTED = "rejected";
    const STATUS_APPROVED = "approved";
    const STATUS_INTERVIEW = "interview";
    const STATUS_JOB_OFFER = "offer_job";
    const STATUS_CONFIRMED = "confirmed";



    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'com_id', 'branch_id', 'job_id', 'name', 'email', 'phone', 'cover_later', 'expected_salary', 'is_declined', 'decline_reason', 'status'
    ];

    //Return parent job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

}
