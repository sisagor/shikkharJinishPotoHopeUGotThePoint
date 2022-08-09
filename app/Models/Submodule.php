<?php

namespace App\Models;


class Submodule extends RootModel {

    //
    protected $table = 'submodules';

    protected $fillable = [
        'id', 'module_id', 'name', 'show', 'status'
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'submodule_id', 'id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'submodule_id', 'id');
    }


}
