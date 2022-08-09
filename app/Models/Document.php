<?php

namespace App\Models;

class Document extends RootModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'doc_name',
        'path',
        'ext',
        'order',
        'size',
        'documentable_id',
        'documentable_type',
        'status'
    ];

    /**
     * Get all of the owning imageable models.
     */
    public function documentable()
    {
        return $this->morphTo();
    }

    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getSizeInKbAttribute()
    {
        return $this->size ? round($this->size / 1024, 2) : Null;
    }

}
