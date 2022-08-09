{{--Common Modal Laypout --}}
{{--Size will provide from child --}}
<div class="modal-dialog modal-{{($size ?? 'lg') }}">
    <div class="modal-content">
        <form method="post" id="modalForm" enctype="multipart/form-data"
              action="{{ (!empty(session('actionId')) ? route(session('action'), session('actionId')) : route(session('action')))}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{trans('app.'.session('actionTitle'))}}</h4>
                <button id="close_modal" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
            </div>

            <div class="modal-body">

                @yield('modal')

            </div>
            <div class="modal-footer footer-content">
                <button id="submitButton" type="submit" onclick="return confirm('Are you sure?')" name="submit"
                        value="1" class="btn btn-primary">
                    @if(!empty(session('actionId'))) {{session('actionBtn') ?? trans('app.update')}} @else {{ session('actionBtn') ?? trans('app.save') }} @endif
                </button>
                <button type="button" id="close_modal" class="close btn btn-secondary"  data-dismiss="modal">{{trans('app.close')}}</button>
            </div>

        </form>

    </div>
</div>
@include('scripts.dateMonthYearPicker')
@include('scripts.modalScript')
@php
  session(['action' => null, 'actionId' => null, 'actionTitle' => null, 'actionBtn' => null])
@endphp

