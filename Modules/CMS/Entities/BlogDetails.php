<?php

namespace Modules\CMS\Entities;

use App\Common\Imageable;
use App\Models\RootModel;
use App\Models\Image;

class BlogDetails extends RootModel
{
    use Imageable;

    protected $table = 'blog_details';


    const TYPE_HOME = "home";
    const TYPE_BLOG = "blog";

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'blog_id', 'details', 'order', 'status',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'imageable_id', 'id')->where('type', 'blog');
    }

}
