@extends('layouts.report', ['title' => 'on_leave', 'filter' => 1])

@section('filter')

    {!! date_filter_filed(5) !!}
@endsection

{{--@section('button')
    <button class="btn btn-warning">{{trans('app.review')}}</button>
@endsection--}}

@section('report')
    <table class="attendance-onLeave table table-striped table-bordered no-footer dtr-inline w-100"
           role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.first_name')}}</th>
            <th>{{trans('app.last_name')}}</th>
            <th>{{trans('app.start_date')}}</th>
            <th>{{trans('app.end_date')}}</th>
            <th>{{trans('app.leave_days')}}</th>
            <th>{{trans('app.leave_type')}}</th>
            {{--<th>{{trans('app.approval_status')}}</th>--}}
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('reportScript')
    @include('timesheet::scripts.script')
@endsection
