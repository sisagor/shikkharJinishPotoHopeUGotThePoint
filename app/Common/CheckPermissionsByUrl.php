<?php

namespace App\Common;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

/**
* @author Inta-Dev
 */
class CheckPermissionsByUrl
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

    //get menu which set befor
    private function getMenu(): array
    {
        return $this->menu;
    }

    //get menu which set before
    public static function hasPermissionByUrl($url): bool
    {
        return (new self())->checkMenuPermission($url);
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
    private function checkMenuPermission($url): bool
    {
        //check if haas skip permission:
        if ($this->skipPermission()) {
            $this->setPermission(true);
            return true;
        }

        //check url permission
        $this->getMenuFromUrl($url);

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
    private function getMenuFromUrl($url): bool
    {
        $modules = Cache::get('role_permissions_' . Auth::id());
        ///Check if module menu permission exist:
        $modules->map(function ($module) use($url){

            $module->submodules->map(function ($submodule) use ($module, $url) {

                $submodule->menu->map(function ($menu) use ($module, $submodule, $url) {

                    if ($url){
                        if (str_contains($menu->url, $url)) {

                            $this->setMenu([
                                'module_id' => $module->id,
                                'submodule_id' => $submodule->id,
                                'id' => $menu->id,
                                'name' => $menu->name,
                                'url' => $menu->url,
                                'moduleUrl' => $module->url,
                            ]);
                        }
                    }
                });
            });
        });
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
