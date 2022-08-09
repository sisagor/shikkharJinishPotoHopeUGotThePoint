@extends('layouts.table', ['title' => 'rejected_applications', 'btnType' => 'modal', 'filter' => 1])


@section('filter')
    {!! date_filter_filed(5) !!}
@endsection

@section('table')
    <table class="leave-application-rejected table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.first_name')}}</th>
            <th>{{trans('app.last_name')}}</th>
            <th>{{trans('app.leave_type')}}</th>
            <th>{{trans('app.leave_for')}}</th>
            <th>{{trans('app.start_date')}}</th>
            <th>{{trans('app.end_date')}}</th>
            <th>{{trans('app.leave_days')}}</th>
            <th>{{trans('app.leave_hour')}}</th>
            <th>{{trans('app.approval_status')}}</th>
            <th>{{trans('app.rejected_by')}}</th>
            <th>{{trans('app.details')}}</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

@endsection

@section('tableScript')
    @include('timesheet::scripts.script')
@endsection
