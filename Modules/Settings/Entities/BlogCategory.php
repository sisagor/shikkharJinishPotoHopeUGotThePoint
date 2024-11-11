<?php
namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Modules\CMS\Entities\Blog;
use App\Common\Imageable;
use App\Models\Image;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogCategory extends RootModel
{
    use Imageable, SoftDeletes;

    protected $table = "blog_categories";

    protected $fillable = ['id', 'title', 'name', 'details', 'status'];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'id', 'imageable_id')->where('type', 'blog_category');
    }


}