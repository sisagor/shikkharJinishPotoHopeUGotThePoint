@extends('layouts.report', ['title' => 'report', 'filter' => 1])

@section('filter')
    {!! employee_search_filed(3) !!}
@endsection


@section('report')
    <table class="report-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.manager')}}</th>
            <th>{{trans('app.employee')}}</th>
            <th>{{trans('app.project')}}</th>
            <th>{{trans('app.title')}}</th>
            <th>{{trans('app.office_id')}}</th>
            <th>{{trans('app.site_id')}}</th>
            <th>{{trans('app.mobile_bill')}}</th>
            <th>{{trans('app.allowance')}}</th>
            <th>{{trans('app.other_bill')}}</th>
            <th>{{trans('app.total')}}</th>
            <th>{{trans('app.due_advance')}}</th>

        </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>{{ trans('app.total') }}</th>
        <th></th>
        <th></th>
        </tfoot>
    </table>
@endsection

@section('reportScript')
    @include('billing::scripts.report')
@endsection
