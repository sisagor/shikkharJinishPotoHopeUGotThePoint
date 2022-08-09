<?php

namespace App\Common;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

/**
* @author Inta-Dev
 */
class CheckPermissionsByAction
{
    /**current menu will store here*/
    private $menu = array();

    /**Has menu or not*/
    private $hasMenu = false;

    /** Has permission or not*/
    private $hasPermission = false;

    //Set menu from url:
    private function setMenu(array $array)
    {
        $this->menu = $array;
    }

    //Set public menu from url:
    private function setPublicMenu($action)
    {
        if ($this->menu) {
            switch ($action) {
                case 'add' :
                    Session::put('addAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'list' :
                    Session::put('listAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'edit' :
                    Session::put('editAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'delete' :
                    Session::put('deleteAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'restore' :
                    Session::put('restoreAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'trash' :
                    Session::put('trashAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'view' :
                    Session::put('viewAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'import' :
                    Session::put('importAction', json_decode(json_encode($this->menu), false));
                    break;
                case 'export' :
                    Session::put('exportAction', json_decode(json_encode($this->menu), false));
                    break;

                default :
                    return;
            }
        }

        return;
    }

    //get menu which set befor
    private function getMenu(): array
    {
        return $this->menu;
    }

    //get menu which set before
    public static function hasPermission($action): bool
    {
        return (new self())->checkMenuPermission($action);
    }

    private function setPermission($permission): bool
    {
        return $this->hasPermission = $permission;
    }

    private function getPermission(): bool
    {
        return $this->hasPermission;
    }

    /**
     * Check Menu and action Permission:
     */
    private function checkMenuPermission($action): bool
    {
        //check if haas skip permission:
        if ($this->skipPermission()) {
            $this->setPermission(true);
            return true;
        }
        ///get menu from usrl;
        $this->getMenuFromUrl();

        if ($action) {
            $this->getActionDetails($action);
        }

        if (empty($this->getMenu())) {
            $this->setPermission(false);
            return false;
        }

        if (is_super_admin()) {
            $this->setPermission(true);
        }

        //Get all modules from Cache:
        $modules = Cache::get('role_permissions_' . Auth::id());
        ///Check if module menu permission exist:
        $modules->map(function ($module) {

            if (str_contains($module->id, $this->getMenu()['module_id'])) {

                $module->submodules->map(function ($submodule) {

                    if (str_contains($submodule->id, $this->getMenu()['submodule_id'])) {

                        $submodule->menu->map(function ($menu) {
                            if (str_contains($menu->id, $this->getMenu()['id'])) {
                                $this->setPermission(true);
                            }
                        });
                    }
                });
            }
        });

        if ($this->getPermission()) {
            return true;
        }

        return false;
    }

    /**
     * Get Menu details from Url:
     */
    private function getMenuFromUrl(): bool
    {
        $modules = Cache::get('role_permissions_' . Auth::id());
        ///Check if module menu permission exist:
        $modules->map(function ($module){

            $module->submodules->map(function ($submodule) use ($module) {

                $submodule->menu->map(function ($menu) use ($module, $submodule) {

                    if (str_contains($menu->url, unserialize(get_menu_url()))) {

                        $this->setMenu([
                            'module_id' => $module->id,
                            'submodule_id' => $submodule->id,
                            'id' => $menu->id,
                            'name' => $menu->name,
                            'url' => $menu->url,
                            'moduleUrl' => $module->url,
                        ]);
                    }
                });
            });
        });

        return true;
    }


    /**get Action Details*/

    private function getActionDetails($action): bool
    {
        $modules = Cache::get('role_permissions_' . Auth::id());
        $this->getMenuFromUrl();
        ///Check if module menu permission exist:
        $modules->map(function ($module) use ($action) {

            if (str_contains($module->id, $this->getMenu()['module_id'])) {

                $module->submodules->map(function ($submodule) use ($module, $action) {

                    if (str_contains($submodule->id, $this->getMenu()['submodule_id'])) {

                        $submodule->menu->map(function ($menu) use ($module, $submodule, $action) {

                            if ($menu->action === $action) {
                                $this->setMenu([
                                    'module_id' => $module->id,
                                    'submodule_id' => $submodule->id,
                                    'id' => $menu->id,
                                    'name' => $menu->name,
                                    'url' => $menu->url,
                                    'moduleUrl' => $module->url,
                                ]);
                                $this->setPublicMenu($action);
                                $this->hasMenu = true;
                            }

                        });
                    }
                });
            }
        });

        if (! $this->hasMenu) {
            $this->setMenu([]);
        }

        return true;
    }

    /**
     * skip  permissions if exist in config skip:
     */
    private function skipPermission(): bool
    {
        $menuUrl = unserialize(get_menu_url());
        $skips = config('permission.skip');

        if (empty($menuUrl)) {
            return true;
        }

        $filter = array_filter($skips, function ($permission) use ($menuUrl) {
            return str_contains($menuUrl, $permission);
        });

        if (empty($filter)) {
            return false;
        }
        return true;
    }


}
