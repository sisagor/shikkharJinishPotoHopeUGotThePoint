<?php

namespace App\Models;


class Menu extends RootModel {
    //
    protected $table = 'menu';

    protected $fillable = [
        'id', 'submodule_id', 'name', 'url', 'action', 'show', 'status',
    ];

    public function submodule()
    {
        return $this->belongsTo(Submodule::class, 'submodule_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'menu_id', 'id');
    }

}
