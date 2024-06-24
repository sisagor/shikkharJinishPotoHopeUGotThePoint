<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * compose partial view of role form
     */
    private function composeLeftMenu()
    {
        View::composer(

        'partials.menu.left_menu',

            function($view)
            {
               /* $view->with('left_menu', list_helper::activeAnnouncement());
                $view->with('unread_messages', ListHelper::unreadMessages());*/
            }
        );
    }

}
