<?php

namespace Modules\CMS\Entities;

use App\Models\RootModel;
use App\Common\Imageable;



class Comment extends RootModel
{
    use Imageable;

    protected $table = 'comments';

    protected $fillable = [
        'id', 'blog_id', 'user_id', 'name', 'email', 'comment', 'parent_id'
    ];


    public function replays()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    } 

}
