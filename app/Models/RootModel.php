<?php

namespace App\Models;

use App\Common\RootModelTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;


abstract class RootModel extends Model
{
    ##this will clear cache when update model:
    use RootModelTask;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const PRESENT = 1;
    const ABSENT = 0;

    const DEVICE_ONLINE = 1;

    const DATA_ACTIVE = "Active";
    const DATA_INACTIVE= "Inactive";
    const DATA_TRASH = "trash";

    const APPROVAL_STATUS_PENDING = 0;
    const APPROVAL_STATUS_APPROVED = 1;
    const APPROVAL_STATUS_REJECTED = 2;

    /**
     * Scope a query to only include active records.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', RootModel::STATUS_ACTIVE);
    }


  /**
     * Scope a query to only include active records.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('status', RootModel::STATUS_INACTIVE);
    }


    /**
     * return data if branch or company only self data
     */
    public function scopeMine($query)
    {
        return match (Auth::user()->level) {
            User::USER_ADMIN_ADMIN, User::USER_SUPER_ADMIN => (request()->filled('com_id') ? $query->where('com_id', request()->get('com_id')) : $query),
            User::USER_COMPANY_ADMIN => $query->where(function ($q) {
                $q->where('com_id', com_id());
            }),
            User::USER_ADMIN => (com_id() ? $query->where('com_id', Auth::user()->com_id) : $query),
            User::USER_EMPLOYEE => (Schema::hasColumn($this->getTable(), 'employee_id')
                ? $query->where('employee_id', Auth::user()->employee_id)
                : $query),
            User::USER_MANAGER => (Schema::hasColumn($this->getTable(), 'manager_id')
                ?  $query->where('manager_id', Auth::id())
                : $query),
            default => $query,
        };
    }

    /**
     * return data if company id found
     */
    public function scopeCompanyScope($query)
    {
        return (is_company_admin()
            ? $query->where(function ($q){
                $q->where('com_id', com_id())->orWhere('com_id', null);
            })
            : (request()->filled('com_id')
            ? $query->where('com_id', request()->get('com_id'))
            : $query));
    }



    /**
     * return data if company id found this is common for company and branch
     */
    public function scopeCommonScope($query)
    {
        return (com_id()
            ?  $query->where(function ($q){
                $q->where('com_id', com_id())->orWhere('com_id', null);
            })
            : (request()->filled('com_id')
                ? $query->where('com_id', request()->get('com_id'))
                : $query)
            );
    }


}
