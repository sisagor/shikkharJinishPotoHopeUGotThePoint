<?php

namespace App\Models;

use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends RootModel
{

    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = ['id', 'com_id', 'name', 'level', 'details', 'status'];

    public static $fetch = ['id', 'com_id', 'name', 'level', 'details', 'status'];

    const ROLE_ADMIN = "admin";
    const ROLE_COMPANY = "branch";
    const ROLE_EMPLOYEE = "employee";
    const ROLE_ADMIN_USER = "admin_user";

    /**get all users*/
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**get all permissions*/
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id', 'id');
    }

    /**Companies*/
    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }


}
