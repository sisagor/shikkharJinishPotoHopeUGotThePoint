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

    const DATA_ACTIVE = "active";
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
        switch (Auth::user()->level) {

            case User::USER_ADMIN_ADMIN:
            case User::USER_SUPER_ADMIN :
                    $query = (request()->filled('com_id') ?  $query->where('com_id', request()->get('com_id')) : $query);
                    return  (request()->filled('branch_id') && Schema::hasColumn($this->getTable(), 'branch_id')
                        ?  $query->where('branch_id', request()->get('branch_id'))
                        : $query);
                break;

            case User::USER_COMPANY_ADMIN :

                return (request()->filled('branch_id')
                        ? $query->where('branch_id', request()->get('branch_id'))
                        : (! is_branch_group() && Schema::hasColumn($this->getTable(), 'branch_id')
                            ? $query->where('com_id', com_id())->whereNull('branch_id')
                            : $query
                        )
                );
                break;

            case User::USER_BRANCH_ADMIN :
                return (Schema::hasColumn($this->getTable(), 'branch_id')
                    ? $query->where('branch_id', branch_id())
                    : $query
                );
                break;

            case User::USER_ADMIN :
                return (branch_id() && Schema::hasColumn($this->getTable(), 'branch_id')
                    ? $query->where('branch_id', Auth::user()->branch_id)
                    : (com_id() ? $query->where('com_id', Auth::user()->com_id)
                    : $query)
                );
                break;

            case User::USER_EMPLOYEE :
                return (Schema::hasColumn($this->getTable(), 'employee_id')
                    ? $query->where('employee_id', Auth::user()->employee_id)
                    : $query);
                break;

            default :
                return $query;
        }
    }

    /**
     * return data if company id found
     */
    public function scopeCompanyScope($query)
    {
        return (is_company_admin() ? $query->where('com_id', com_id()) : $query);
    }


    public function scopeBranchScope($query)
    {
        return (is_branch_admin() ? $query->where('branch_id', branch_id())
            :  (request()->filled('branch_id') ? $query->where('branch_id', request()->get('branch_id'))
                : $query)
        );
    }

    /**
     * return data if company id found this is common for company and branch
     */
    public function scopeCommonScope($query)
    {
        return (com_id() ?  $query->where('com_id', com_id())
            : (request()->filled('com_id') ? $query->where('com_id', request()->get('com_id'))
                : $query)
            );
    }


}
