<?php

namespace Modules\User\Entities;

use App\Models\User;
use App\Models\RootModel;
use App\Common\Imageable;
use App\Common\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;


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
        'branch_id',
        'name',
        'phone',
        'email',
        'dob',
        'gender',
        'address',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'profile_id', 'id');
    }


}
