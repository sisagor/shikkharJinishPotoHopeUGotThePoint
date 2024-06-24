<?php

namespace App\Models;

class ScheduleJob extends RootModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schedule_jobs';

    const ACTION_CREATE  = "create";
    const ACTION_UPDATE  = "update";
    const ACTION_DELETE  = "update";


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    public $fillable = ['class', 'class_id', 'action', 'action_date', 'data'];

    public $fetch = ['class', 'class_id', 'action', 'action_date', 'data'];


}
