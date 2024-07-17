<?php

namespace Modules\CMS\Entities;

use App\Models\RootModel;
use App\Common\Imageable;
use App\Common\CascadeSoftDeletes;
use Modules\Settings\Entities\BlogCategory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends RootModel
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $table = 'blogs';

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'com_id', 'blog_category_id', 'title', 'order', 'status', 'created_by'
    ];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(BlogDetails::class, 'blog_id', 'id');
    }

}
