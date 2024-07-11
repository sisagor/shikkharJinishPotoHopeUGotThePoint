<?php

namespace Modules\Company\Entities;

use App\Models\RootModel;

class CompanySetting extends RootModel
{

    const ATTENDANCE_IP = "ip_based";
    const ATTENDANCE_MANUAL = "manual";

    protected $table = 'company_settings';

    public $timestamps = false;

    protected $fillable = [
        'com_id', 'key', 'value',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**
     * @return company active or not
     */
    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }


}
