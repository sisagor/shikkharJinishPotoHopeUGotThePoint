{{--return Add button--}}
<a href="javascript:void(0)" data-link="{{ get_menu_route(session('addAction')) }}" class="ajax-modal-btn btn btn-info">
    <i class="fa fa-plus"></i> &nbsp;{{ trans('app.' . strtolower(str_replace(' ', '_', session('addAction')->name)))}}&nbsp;&nbsp;
</a>




