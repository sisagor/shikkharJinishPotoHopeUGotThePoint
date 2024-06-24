{{--return Add button--}}
<a class="btn btn-info" href="{{ get_menu_route(session('addAction')) }}">
    <i class="fa fa-plus"></i>&nbsp; {{ trans('app.' . strtolower(str_replace(' ', '_', session('addAction')->name)))}} &nbsp;&nbsp;
</a>

