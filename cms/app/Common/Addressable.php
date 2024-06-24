<?php

namespace App\Common;


use App\Models\Address;
use App\Models\Country;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on Addresses
 *
 * @author Inta-Dev
 */
trait Addressable
{

    /**
     * Check if model has an address.
     *
     * @return bool
     */
    public function hasAddress()
    {
        return (bool)$this->addresses()->count();
    }

    /**
     * Check if model has an address.
     *
     * @return bool
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Return any address related to the model model
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function address()
    {
        return $this->addresses->first();
    }

    /**
     * Return collection of addresses related to the tagged model
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }


    /**
     * Fetch billing address
     *
     * @return Address or null
     */
    public function presentAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('type', 'present');
    }

    /**
     * Fetch billing address
     *
     * @return Address or null
     */
    public function permanentAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('type', 'permanent');
    }


    /**
     * Deletes all the addresses of this model.
     *
     * @return bool
     */
    public function flushAddresses()
    {
        return $this->addresses()->delete();
    }
}
