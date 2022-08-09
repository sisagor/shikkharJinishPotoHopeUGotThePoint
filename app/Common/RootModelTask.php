<?php

namespace App\Common;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

/**
 * @author Inta-dev
*/
trait RootModelTask
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            $table = $model->getTable();

            if (! is_admin_group() && Schema::hasColumn($table, 'com_id') && ( \request()->get('com_id') || Auth::user()->com_id)) {
                $model->com_id = \request()->get('com_id') ?? Auth::user()->com_id;
            }

            if (! is_admin_group() && Schema::hasColumn($table, 'branch_id') && (\request()->get('branch_id') || Auth::user()->branch_id))
            {
                $model->branch_id = \request()->get('branch_id') ?? Auth::user()->branch_id;
            }

            if (Schema::hasColumn($table, 'created_by')) {
                $model->created_by = Auth::id();
            }

            self::clearCacheOnChange($model);

        });

        static::deleting(function ($model) {

            self::clearCacheOnChange($model);

        });
    }


    private static function clearCacheOnChange($model)
    {
        $table = $model->getTable();
        Cache::forget($table);
        Cache::forget($table);
        Cache::forget($table . CACHE_COMMON);
        Cache::forget($table . CACHE_COMMON . com_id());
        Cache::forget($table . CACHE_COMMON . branch_id());

        Cache::forget($table . CACHE_LIST);
        Cache::forget($table . CACHE_LIST . Auth::id());

        Cache::forget($table . CACHE_USER . Auth::id());
        Cache::forget($table . CACHE_SINGLE);
        Cache::forget($table . CACHE_SINGLE . Auth::id());
        Cache::forget($table . CACHE_DASHBOARD . Auth::id());

    }

}
