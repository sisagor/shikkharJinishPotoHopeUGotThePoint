<?php

namespace Modules\CMS\Entities;

use App\Models\RootModel;

class BlogBook extends RootModel
{


    protected $table = 'blog_books';

    protected $fillable = [
        'id', 'blog_id', 'book_id'
    ];

    public static $select = [
       'id', 'blog_id', 'book_id'
    ];


    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

}
