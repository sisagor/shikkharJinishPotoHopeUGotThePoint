<?php

namespace App\Models;

class SeoPage extends RootModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seo_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'description',
        'keywords',
        'author',
        'section',
        'canonical',
        'og_locale',
        'og_url',
        'og_type',
        'page_id',
        'type',
        'status'
    ];


}
