<?php

use App\Common\Permission;


if (! function_exists('add_button')) {
    /**add new button*/
    function add_button(string $action, string $name, $type = 1)
    {
        if (! Permission::hasPermission($action)) {
            return false;
        }

        if (! $type) {

            return '<li><a id="'.strtolower(str_replace('.', '_', $action)).'" class="btn btn-info" href="'
                . route($action) . '" title="'.trans('app.'. $name).'">
                <i class="fa fa-plus"></i>&nbsp; ' . trans('app.' . $name) . '&nbsp;&nbsp; </a> </li>';
        }

        return '<a id="'.strtolower(str_replace('.', '_', $action)).'" href="javascript:void(0)" data-link="' . route($action) . '"
            class="ajax-modal-btn btn btn-info" title="'.trans('app.' . $name).'">
            <i class="fa fa-plus"></i>&nbsp;' . trans('app.' . $name) . '&nbsp;&nbsp;</a>';
    }
}

if (! function_exists('list_button')) {
    /**List button*/
    function list_button(string $action, string $name)
    {
        if (! Permission::hasPermission($action)) {
            return false;
        }

        return '<li><a class="btn btn-info" id="'. strtolower(str_replace('.', '_', $action)).'" href="' . route($action) . '"
                title="'.trans('app.'. $name ).'">
                <i class="fa fa-list"></i>&nbsp; ' . trans('app.'. $name) . '&nbsp;&nbsp;</a></li>';
    }
}


if (! function_exists('edit_button')) {
    /** Edit new button*/
    function edit_button(string $action, $id, $type = 1)
    {
        if (! Permission::hasPermission($action))
        {
            return false;
        }

        if (\Illuminate\Support\Facades\Auth::user()->com_id && isset($id->com_id))
        {
            if (\Illuminate\Support\Facades\Auth::user()->com_id !== $id->com_id)
            {
              return false;
            }
        }

        if (! $type)
        {
            return '<a id="'.strtolower(str_replace('.', '_', $action)).'" class="btn btn-secondary " href="' . route($action, $id) . '"
            title="'.trans('app.edit').'">
                <i class="fa fa-pencil-square-o button_icon"></i>
            </a>';
        }
        return '<a href="javascript:void(0)" data-link="' . route($action, $id) . '"
                class="ajax-modal-btn btn btn-secondary"  title="'.trans('app.edit').'">
                <i class="fa fa-pencil-square-o button_icon"></i>
            </a>';
    }
}


if (! function_exists('view_button')) {
    /** Edit new button*/
    function view_button(string $action, $id, $type = 1)
    {
        if (! Permission::hasPermission($action))
        {
            return false;
        }

        if (! $type)
        {
            return '<a class="btn btn-default custom-button" href="' . route($action, $id) . '" title="'.trans('app.view').'">
                    <i class="fa fa-eye button_icon"></i>
                </a>';
        }

        return '<a href="javascript:void(0)" data-link="' . route($action, $id) . '"
                class="ajax-modal-btn btn btn-default custom-button" title="'.trans('app.view').'">
                <i class="fa fa-eye button_icon"></i> </a>';
    }
}


if (! function_exists('delete_button')) {
    /**add new button*/
    function delete_button(string $action, $id)
    {
        if (! Permission::hasPermission($action))
        {
            return false;
        }

        if ( isset($id->com_id))
        {
            if (\Illuminate\Support\Facades\Auth::user()->com_id !== $id->com_id)
            {
                return false;
            }
        }

        return '<a class="btn btn-danger" onclick="return confirm(\'are you sure?\')" href="' . route($action, $id) . '"
                title="'.trans('app.delete').'">
                <i class="fa fa-trash-o button_icon"> </i> </a>';
    }
}


/*custom button*/
if (! function_exists('custom_ajax_button')) {
    function custom_ajax_button(string $action, string $name,  $class = null, $item = null)
    {
        if(Permission::hasPermission($action))
        {
            return false;
        }

        return '<a href="javascript:void(0)" data-link="' . route($action, $item ?? null) . '" class="ajax-modal-btn btn btn-' . $class ?? "info" .
            '">' . trans('app.' . $name) . '</a > ';
    }
}

/*custom button*/
if (! function_exists('custom_button')) {
    function custom_button(string $action, string $name,  $class = null, $item = null)
    {
        if(Permission::hasPermission($action))
        {
            return false;
        }

        return '<a href="' . route($action, $item ?? null) . '" class="btn btn-' . $class ?? "info" . '">' . trans('app.' . $name) . ' </a > ';
    }
}


if (! function_exists('restore_button')) {
    /** Edit via action */
    function restore_button(string $action, $id)
    {
        if (! Permission::hasPermission($action)) {
            return false;
        }

        return '<a class="btn btn-primary" onclick="return confirm(\'are you sure?\')"
                href="' . route($action, $id) . '"  title="'.trans('app.restore').'">
                <i class="fa fa-arrow-circle-o-up button_icon"> </i> </a>';
    }
}

if (! function_exists('trash_button')) {
    /**add new button*/
    function trash_button(string $action, $id)
    {
        if (! Permission::hasPermission($action))
        {
            return '';
        }

        if (isset($id->com_id))
        {
            if (\Illuminate\Support\Facades\Auth::user()->com_id !== $id->com_id)
            {
                return '';
            }
        }

        return '<a class="btn btn-warning" onclick="return confirm(\'are you sure?\')"
                href="' . route($action, $id) . '"  title="'.trans('app.move_to_trash').'">
                <i class="fa fa-trash-o button_icon"> </i> </a>';
    }
}





