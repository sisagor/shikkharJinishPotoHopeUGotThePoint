{{--return Add button--}}
<a class="btn btn-info" href="{{  get_menu_route(session('listAction')) }}">
    <i class="fa fa-list"></i>&nbsp; {{ trans('app.' . strtolower(str_replace(' ', '_', session('listAction')->name))) }}&nbsp;&nbsp;
</a>
