<?php

namespace Modules\CMS\Entities;

use App\Models\RootModel;
use App\Common\Imageable;



class Contact extends RootModel
{
    use Imageable;

    protected $table = 'contacts';

    protected $fillable = [
        'id', 'name', 'email', 'mobile', 'message'
    ];


}
