<?php

use \App\Common\CheckPermissionsByAction;


if (! function_exists('add_button')) {
    /**add new button*/
    function add_button(string $type = null)
    {
        if (! CheckPermissionsByAction::hasPermission('add')) {
            return false;
        }

        if (! session('addAction')) {
            return false;
        }

        if (! $type) {
            return '<a id="'.strtolower(str_replace(' ', '_', session('addAction')->name)).'" class="btn btn-info" href="'
                . get_menu_route(session('addAction')) . '" title="'.trans('app.add_new').'">
                <i class="fa fa-plus"></i>&nbsp; ' . trans('app.' .
                strtolower(str_replace(' ', '_', session('addAction')->name))) . '
                &nbsp;&nbsp; </a>';
        }

        return '<a id="'.strtolower(str_replace(' ', '_', session('addAction')->name)).'"
            href="javascript:void(0)" data-link="' . get_menu_route(session('addAction')) . '"
            class="ajax-modal-btn btn btn-info" title="'.trans('app.add_new').'">
            <i class="fa fa-plus"></i>&nbsp;' . trans('app.' . strtolower(str_replace(' ', '_', session('addAction')->name))) .
            '&nbsp;&nbsp;</a>';
    }
}

if (! function_exists('list_button')) {
    /**List button*/
    function list_button()
    {
        if (! CheckPermissionsByAction::hasPermission('list')) {
            return false;
        }

        if (! session('listAction')) {
            return false;
        }

        return '<a class="btn btn-info" id="'. strtolower(str_replace(' ', '_', (session('listAction'))->name)).'" href="' . get_menu_route(session('listAction')) . '"
                title="'.trans('app.list').'">
                <i class="fa fa-list"></i>&nbsp; ' .
                trans('app.' . strtolower(str_replace(' ', '_', (session('listAction'))->name)))
                . '&nbsp;&nbsp;</a>';
    }
}


if (! function_exists('edit_button')) {
    /** Edit new button*/
    function edit_button($id, string $type = null)
    {
        if (! CheckPermissionsByAction::hasPermission('edit')) {
            return false;
        }

        if (! session('editAction')) {
            return false;
        }

        if (! $type) {
            return '<a id="'.strtolower(str_replace(' ', '_', session('editAction')->name)).'" class="btn btn-info " href="' . get_menu_route(session('editAction'), $id) . '"
            title="'.trans('app.edit').'">
                <i class="fa fa-pencil-square-o button_icon"></i>
            </a>';
        }
        return '<a href="javascript:void(0)" data-link="' . get_menu_route(session('editAction'), $id) . '"
                class="ajax-modal-btn btn btn-info"  title="'.trans('app.edit').'">
                <i class="fa fa-pencil-square-o button_icon"></i>
            </a>';

    }
}


if (! function_exists('view_button')) {
    /** Edit new button*/
    function view_button($id, $type = null)
    {
        if (! CheckPermissionsByAction::hasPermission('view')) {
            return false;
        }

        if (! session('viewAction')) {
            return false;
        }

        if (! $type) {
            return '<a class="btn btn-default custom-button" href="' . get_menu_route(session('viewAction'), $id) . '" title="'.trans('app.view').'">
                    <i class="fa fa-eye button_icon"></i>
                </a>';
        }

        return '<a href="javascript:void(0)" data-link="' . get_menu_route(session('viewAction'), $id) . '"
                class="ajax-modal-btn btn btn-default custom-button" title="'.trans('app.view').'">
                <i class="fa fa-eye button_icon"></i> </a>';
    }
}


if (! function_exists('delete_button')) {
    /**add new button*/
    function delete_button($id)
    {
        if (! CheckPermissionsByAction::hasPermission('delete')) {
            return false;
        }

        if (! session('deleteAction')) {
            return false;
        }

        return '<a class="btn btn-danger" onclick="return confirm(\'are you sure?\')"
                href="' . get_menu_route(session('deleteAction'), $id) . '"  title="'.trans('app.delete').'">
                <i class="fa fa-trash-o button_icon"> </i>
                </a>';
    }
}


/*custom button*/
if (! function_exists('custom_ajax_button')) {
    function custom_ajax_button($name, $url, $class = null, $item = null)
    {
        return '<a href="javascript:void(0)" data-link="' . route($url, $item ?? null) . '" class="ajax-modal-btn btn btn-' . $class ?? "info" .
            '">' . trans('app.' . $name) . '
                </a > ';
    }
}

/*custom button*/
if (! function_exists('approve_button')) {
    function approve_button($row, $url = null)
    {
        if (is_employee()){
            return null;
        }

        return '<a href="javascript:void(0)" title="approve item" data-link="' . route($url, $row->id ?? null) . '" class="approve-btn btn btn-success"  title="'.trans('app.approve').'">' . trans('app.approve') . '</a>';
    }
}



if (! function_exists('edit_via_action')) {
    /** Edit via action */
    function edit_via_action($action, $id, $route, string $type = null)
    {
        if (! CheckPermissionsByAction::hasPermission($action)) {
            return false;
        }

        if (! $type) {
            return '<a id="'.$action.'" class="btn btn-dark " href="' . route($route, $id) . '"  title="'.trans('app.edit').'">
                <i class="fa fa-pencil-square-o button_icon"></i>
            </a>';
        }
        return '<a href="javascript:void(0)" data-link="' . route($route, $id) . '"
                class="ajax-modal-btn btn btn-dark"  title="'.trans('app.edit').'">
                <i class="fa fa-pencil-square-o button_icon"></i>
            </a>';
    }
}

if (! function_exists('restore_button')) {
    /** Edit via action */
    function restore_button($id)
    {
        if (! CheckPermissionsByAction::hasPermission('restore')) {
            return false;
        }

        if (! session('restoreAction')) {
            return false;
        }

        return '<a class="btn btn-primary" onclick="return confirm(\'are you sure?\')"
                href="' . get_menu_route(session('restoreAction'), $id) . '"  title="'.trans('app.restore').'">
                <i class="fa fa-arrow-circle-o-up button_icon"> </i>
                </a>';
    }
}

if (! function_exists('trash_button')) {
    /**add new button*/
    function trash_button($id)
    {
        if (! CheckPermissionsByAction::hasPermission('trash')) {
            return false;
        }

        if (! session('trashAction')) {
            return false;
        }

        return '<a class="btn btn-warning" onclick="return confirm(\'are you sure?\')"
                href="' . get_menu_route(session('trashAction'), $id) . '"  title="'.trans('app.move_to_trash').'">
                <i class="fa fa-trash-o button_icon"> </i>
                </a>';
    }
}





