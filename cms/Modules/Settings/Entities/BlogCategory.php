<?php

namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CMS\Entities\Blog;


class BlogCategory extends RootModel
{
    use SoftDeletes;

    protected $table = 'blog_categories';

    protected $fillable = [
        'id', 'com_id', 'name', 'details', 'status'
    ];

    public static $fetch = [
        'id', 'com_id', 'name', 'details', 'status'
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id', 'id');
    }


}

