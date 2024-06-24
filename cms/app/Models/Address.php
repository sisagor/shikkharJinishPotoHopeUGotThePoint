<?php

namespace App\Models;

class Address extends RootModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'address',
        'city',
        'state',
        'country_id',
        'addressable_id',
        'addressable_type',
    ];

    /**
     * Get all of the owning imageable models.
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }


}
