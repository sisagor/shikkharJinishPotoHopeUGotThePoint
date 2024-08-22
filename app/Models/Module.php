<?php

namespace App\Models;


class Module extends RootModel
{

    //
    protected $table = 'modules';

    protected $casts = [
        'scope' => 'array'
    ];

    protected $fillable = [
        'id', 'name', 'scope', 'url', 'icon', 'status'
    ];

    const SCOPE_ADMIN = "admin";
    const SCOPE_COMPANY = "company";
    const SCOPE_AUTHOR = "author";
    const SCOPE_BRANCH = "branch";
    const SCOPE_COMMON = "common";
    const SCOPE_EMPLOYEE = "employee";


    public function submodules()
    {
        return $this->hasMany(Submodule::class, 'module_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id', 'id');
    }


}
