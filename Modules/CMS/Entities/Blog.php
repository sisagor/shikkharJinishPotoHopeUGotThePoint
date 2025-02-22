<?php

namespace Modules\CMS\Entities;

use App\Models\RootModel;
use App\Common\Imageable;
use App\Common\CascadeSoftDeletes;
use App\Models\SeoPage;
use Modules\Settings\Entities\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends RootModel
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $table = 'blogs';

    //protected $cascadeDeletes = ['job_applications', 'job_interview'];

    protected $fillable = [
        'id', 'com_id', 'blog_category_id', 'title', 'order', 'status', 'url_type', 'slug', 'created_by', 'view'
    ];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BlogDetails::class, 'blog_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BlogBook::class, 'blog_id', 'id');
    }

    public function seo()
    {
        return $this->belongsTo(SeoPage::class, 'id', 'page_id')->where('type','blog');
    }

}
