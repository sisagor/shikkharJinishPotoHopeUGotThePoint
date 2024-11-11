<?php

namespace Modules\CMS\Entities;

use App\Models\RootModel;
use App\Common\Imageable;
use App\Common\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends RootModel
{
    use Imageable, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'books';

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'name', 'url', 'status', 'view', 'order', 'created_by'
    ];

    public static $select = [
        'id', 'name', 'url', 'status', 'view', 'order', 'created_by'
    ];

}
