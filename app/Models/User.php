<?php

namespace App\Models;

use App\Common\HasPermission;
use App\Common\CascadeSoftDeletes;
use Modules\User\Entities\Profile;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Organization\Entities\Department;
use Modules\Organization\Entities\Designation;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes, CascadeSoftDeletes, HasPermission;

    const USER_SUPER_ADMIN = "super_admin";
    const USER_COMPANY_ADMIN = "branch_admin";
    const USER_ADMIN_ADMIN = "admin_admin";
    const USER_ADMIN = "admin";
    const USER_USER = "user";
    const USER_EMPLOYEE = "employee";
    const USER_MANAGER = "manager";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'com_id',
        'role_id',
        'profile_id',
        'level',
        'email',
        'password',
        'remember_token',
        'status',
        'manager',
    ];

    public static $fetch = [
        'name',
        'com_id',
        'role_id',
        'profile_id',
        'level',
        'email',
        'status',
        'manager',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id')->select(Profile::$fetch);
    }

    public function isSuperAdmin()
    {
        return $this->level == self::USER_SUPER_ADMIN;
    }

    public function isAdmin()
    {
        return $this->level == $this::USER_ADMIN_ADMIN;
    }

    public function isManager()
    {
        return $this->level == $this::USER_MANAGER;
    }

    public function isAdminUser()
    {
        return $this->level == $this::USER_ADMIN;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function designation()
    {
        return $this->hasMany(Designation::class, 'created_by', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function scopeManager($query){
        return $query->where('manager', self::USER_MANAGER);
    }

    public function scopeActive($query){
         return $query->where('status', RootModel::STATUS_ACTIVE);
    }


}
