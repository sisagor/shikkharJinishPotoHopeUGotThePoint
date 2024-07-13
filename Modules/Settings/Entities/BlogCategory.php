<?php
namespace Modules\Settings\Entities;

use App\Models\RootModel;
use Modules\CMS\Entities\Blog;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogCategory extends RootModel
{
    use SoftDeletes;

    protected $table = "blog_categories";

    protected $fillable = ['id', 'name', 'details', 'status'];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }


}