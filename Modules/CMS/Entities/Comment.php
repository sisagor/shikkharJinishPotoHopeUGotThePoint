<?php

namespace Modules\CMS\Entities;

use App\Models\RootModel;
use App\Common\Imageable;
use App\Models\User;


class Comment extends RootModel
{
    //use Imageable;

    protected $table = 'comments';

    protected $fillable = [
        'id', 'blog_id', 'user_id', 'name', 'email', 'comment', 'parent_id', 'status'
    ];


    public function replays()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->where('status',1);
    } 

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }

    public function parent_comment()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
