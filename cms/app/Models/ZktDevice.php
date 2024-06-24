<?php

namespace App\Models;

use Modules\Company\Entities\Company;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZktDevice extends RootModel
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zkteco_devices';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'com_id',
        'ip',
        'port',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fetch = [
        'com_id',
        'ip',
        'port',
        'status',
    ];

    /**
     * Get all of the owning imageable models.
     */

    public function company()
    {
        return $this->belongsTo(Company::class, 'come_id', 'id');
    }
}
