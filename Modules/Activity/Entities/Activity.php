<?php

namespace Modules\Activity\Entities;

use App\Models\RootModel;

class Activity extends RootModel {

    //
    protected $table = 'activities';


    protected $fillable = [
        'id', 'com_id', 'branch_id', 'user_id', 'table', 'row_id', 'action_id', 'title'
    ];


}
