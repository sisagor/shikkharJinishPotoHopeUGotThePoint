<div class="nav_menu">
    <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <nav class="nav navbar-nav">
        <ul class=" navbar-right">
            <li class="nav-item dropdown open pl-30">
                <a href="javascript:(0);" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown"
                   aria-expanded="false">
                    <img src="{!! get_storage_file_url(get_profile_picture_url(), 'tiny_thumb') !!}" alt=""> @if(auth()->user()){!! auth()->user()->name !!}@endif
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{get_profile_url()}}"> {{trans('app.profile')}} || {{get_role_level(auth()->user()->role->level ?? null) ?? "Super Admin"}}</a>

                    @if(is_employee() && com_id() && get_single_company(com_id()))
                        <a class="dropdown-item ajax-modal-btn" href="javascript:void(0)">
                             {{ (get_single_company(com_id()))->name }}
                        </a>
                    @endif

                    <a class="dropdown-item ajax-modal-btn" href="javascript:void(0)"
                       data-link="{!! route('userManagements.user.pass', auth()->user()) !!}">
                        {{trans('app.change_password')}}
                    </a>

                    @if(! is_employee())
                        <a class="dropdown-item ajax-modal-btn" href="javascript:void(0)"
                           data-link="{{route('settings.optimize')}}">
                            {{trans('app.optimize')}}
                        </a>
                    @endif

                    @if(is_admin_group())
                        <a class="dropdown-item ajax-modal-btn" href="javascript:void(0)"
                           data-link="{{route('settings.cache.clear')}}">
                            {{trans('app.clear_all_cache')}}
                        </a>
                    @endif
                    <a class="dropdown-item" target="_blank" href="{{config('app.documentation')}}">{{trans('app.help') ?? "Help"}}</a>
                    <a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> {{trans('app.logout')}}</a>
                </div>
            </li>

            <li role="presentation" class="nav-item dropdown open">
                <a href="javascript:void(0)" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o font25"></i>{{trans('app.notifications')}}
                    <span class="badge bg-green notificationCount">{{ get_count_notification() }}</span>
                </a>
                <ul class="dropdown-menu list-unstyled msg_list" id="add-notification" role="menu" aria-labelledby="navbarDropdown1">

                    <div id="position-top"></div>

                    @foreach(get_notifications() as $notification)
                        <li class="nav-item remove-item-{{$notification->id}}">
                            <a class="dropdown-item @if($notification->unread()) unread-notification-back @endif"
                               onclick="markAsRead('{{$notification->id}}', 1)">
                                {{--  <span class="image"><img src="{{asset('images/user.png')}}" alt="Profile Image"/></span>
                                  <span>--}}
                                <span>{!! $notification->data['name'] !!}</span>
                                <span class="time">
                                     {!!  \Carbon\Carbon::parse($notification->created_at)->diffForHumans() !!}
                                 </span>
                                {{--</span>--}}
                                <span class="message">
                                   {!! $notification->data['activity'] !!}
                                 </span>
                            </a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <div class="text-center">
                            <a href="{{route('notifications')}}"> <strong>{{trans('app.see_all')}}</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>

                </ul>
            </li>
        </ul>
    </nav>
</div>
