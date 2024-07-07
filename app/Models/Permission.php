<?php

namespace App\Models;


class Permission extends RootModel {

    protected $table = 'role_permissions';

    protected $fillable = ['id', 'role_id', 'module_id', 'submodule_id', 'menu_id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**Modules*/
    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    /**Submodules*/
    public function submodules()
    {
        return $this->belongsTo(Submodule::class, 'submodule_id', 'id');
    }

    /**Menus*/
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

}
