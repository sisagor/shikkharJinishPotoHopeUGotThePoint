<?php

namespace Modules\User\Entities;

use App\Models\User;
use App\Models\RootModel;
use App\Common\Imageable;
use App\Common\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;

class Profile extends RootModel
{
    use Imageable, SoftDeletes, CascadeSoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * fallible property
     */

    protected $table = "profiles";

    protected $cascadeDeletes = ['user'];

    protected $fillable = [
        'id',
        'com_id',
        'name',
        'phone',
        'email',
        'dob',
        'gender',
        'address',
        'occupation',
        'about',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
    ];

    public static $fetch = [
        'id',
        'com_id',
        'name',
        'phone',
        'email',
        'dob',
        'gender',
        'address',
        'occupation',
        'about',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'profile_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'id', 'imageable_id')->where('type', 'profile');
    }


}
