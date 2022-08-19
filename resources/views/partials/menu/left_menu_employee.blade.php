<div class="left_col scroll-view">
    <div class="navbar nav_title">
        <a href="{{url('dashboard')}}" class="site_title">
            @if(config('system_settings.logo.path'))
                <img align="center" class="img-responsive avatar-view"
                     src="{{ get_storage_file_url(config('system_settings.logo.path'), 'logo') }}" alt="logo">
            @else
                <i class="fa fa-dashboard"></i>
            @endif
            <span>{{trans('app.dashboard')}}</span>
        </a>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                @if(\Illuminate\Support\Facades\Cache::get('role_permissions_'.user_id()))
                    @foreach(\Illuminate\Support\Facades\Cache::get('role_permissions_'.user_id()) as $module)
                        @if($module->url != "employee")

                            <li class="{{ (get_module_url() == $module->url) ? 'active' : '' }}">
                                <a><i class="{{ $module->icon }}"></i>{{ $module->name }} <span
                                        class="fa fa-chevron-down"></span> </a>

                                @if (count($module->submodules) > 0)

                                    <ul class="nav child_menu">

                                        @foreach ($module->submodules as $subModule)

                                            @if ($subModule->show)
                                                <li><a>{{ $subModule->name }}<span
                                                            class="fa fa-chevron-down submodule-arrow"></span></a>
                                                    <ul class="nav child_menu third-menu">
                                                        @endif
                                                        @foreach ($subModule->menu as $menu)
                                                            @if($menu->show)
                                                                <li class=" @if(unserialize(get_menu_url()) == $menu->url){{ 'current-page' }} @endif">
                                                                    <a href="{{ url(strtolower($menu->url)) }}">{{ $menu->name }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                        @if($subModule->show)
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <!-- /sidebar menu -->
    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a href="{{get_setting_url()}}" data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        {{-- <a data-toggle="tooltip" data-placement="top" title="FullScreen">
             <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
         </a>
         <a data-toggle="tooltip" data-placement="top" title="Lock">
             <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
         </a>--}}
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('logout')}}">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
</div>
