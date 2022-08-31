<?php

namespace Modules\Recruitment\Entities;

use App\Models\RootModel;

class Cms extends RootModel
{
    protected $table = 'cms';

    const TYPE_HOME = "home";
    const TYPE_ABOUT = "about";
    const TYPE_CONTACT = "contact";

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'type', 'content', 'status',
    ];


}
