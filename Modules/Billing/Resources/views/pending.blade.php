@extends('layouts.tableTab', ['title' => 'pending_bills'])

{{--if need custom button use this--}}
@section('buttons')
  {!! add_button('billing.bill.add', 'new_bill', 0) !!}
@endsection

@section('active')
    <table class="pending-active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.manager')}}</th>
            <th>{{trans('app.project')}}</th>
            <th>{{trans('app.title')}}</th>
            <th>{{trans('app.office_id')}}</th>
            <th>{{trans('app.site_id')}}</th>
            <th>{{trans('app.mobile_bill')}}</th>
            <th>{{trans('app.allowance')}}</th>
            <th>{{trans('app.other_bill')}}</th>
            <th>{{trans('app.total')}}</th>
            <th>{{trans('app.bill_history')}}</th>
            <th>{{trans('app.allowance_history')}}</th>
            <th>{{trans('app.attachment')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('trash')
    <table class="pending-trash-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.manager')}}</th>
            <th>{{trans('app.project')}}</th>
            <th>{{trans('app.title')}}</th>
            <th>{{trans('app.office_id')}}</th>
            <th>{{trans('app.site_id')}}</th>
            <th>{{trans('app.mobile_bill')}}</th>
            <th>{{trans('app.allowance')}}</th>
            <th>{{trans('app.other_bill')}}</th>
            <th>{{trans('app.total')}}</th>
            <th>{{trans('app.allowance_history')}}</th>
            <th>{{trans('app.other_bill_history')}}</th>
            <th>{{trans('app.attachment')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')
    @include('billing::scripts.billing')
@endsection
