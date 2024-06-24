<?php

namespace Modules\CMS\Entities;

use App\Common\Imageable;
use App\Models\RootModel;

class BlogDetails extends RootModel
{
    use Imageable;

    protected $table = 'blog_details';

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'blog_id', 'details', 'order', 'status',
    ];

}
