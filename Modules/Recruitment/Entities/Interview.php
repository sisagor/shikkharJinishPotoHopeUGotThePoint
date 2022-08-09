<?php

namespace Modules\Recruitment\Entities;

use App\Models\RootModel;
use App\Common\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Employee\Entities\Employee;


class Interview extends RootModel
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $table = 'job_interview';

    const STATUS_SCHEDULED = "scheduled";
    const STATUS_PASS = "pass";
    const STATUS_FAIL = "fail";


    protected $casts = [
        'interviewers' => 'array'
    ];

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = ['id', 'com_id', 'branch_id', 'job_id', 'job_application_id', 'interview_date', 'address', 'interview_time', 'interviewers', 'details', 'status'];


    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function application()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id', 'id');
    }

    public function getInterviewersAttribute($value)
    {
        if (empty($value)){
            return [];
        }
        // if using casts to array, this should already be done
        $scores =  json_decode(json_decode($value), true);
        //$scores = (is_string($scores) ? explode(',', $scores) : $scores);

        return Employee::whereIn('id', array_values($scores))->select('id', 'name')->get();
    }

}
