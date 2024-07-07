{{--Common Modal Laypout --}}
{{--Size will provide from child --}}
<div class="modal-dialog modal-{{($size ?? 'lg') }}">
    <div class="modal-content" id="print-body">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">{{trans('app.'.$title ?? 'title not set yet')}}</h4>
            <button id="close_modal" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        </div>

        <div class="modal-body">

            @yield('viewModal')

        </div>
        <div class="modal-footer footer-content no-print">
            @if(!empty($print))
                <a target="_blank" href="@if($url){{$url}}@endif" class="btn btn-secondary"> {{trans('app.print')}}</a>
            @endif

            <button type="button" id="close_modal" type="button" data-dismiss="modal"
                    class="close btn btn-secondary"> {{trans('app.close')}}</button>
        </div>
    </div>
</div>
