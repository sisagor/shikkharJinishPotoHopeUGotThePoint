<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">{{trans('app.system_message')}}</h4>
            <button id="close_modal" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <h4 class="text-success">{{$message}}
                <info>✔</info>
            </h4>
        </div>
        <div class="modal-footer footer-content">
            <button type="button" id="close_modal" type="button" data-dismiss="modal"
                    class="close btn btn-secondary"> {{trans('app.close')}}</button>
        </div>
    </div>
</div>


