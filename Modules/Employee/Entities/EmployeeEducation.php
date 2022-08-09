<?php

namespace Modules\Employee\Entities;

use App\Models\User;
use App\Models\RootModel;


class EmployeeEducation extends RootModel {

    protected $table = 'employee_educations';

    protected $fillable = [
        'id', 'employee_id', 'exam_title', 'institute', 'passing_year', 'cgpa', 'out_of', 'created_by', 'status'
    ];

    function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }


}
