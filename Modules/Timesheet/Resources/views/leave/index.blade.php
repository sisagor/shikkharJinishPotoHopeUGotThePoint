@extends('layouts.table', ['title' => 'pending_applications', 'btnType' => 'modal', 'filter' => 1])


@section('filter')
   {!! date_filter_filed(5) !!}
@endsection

@section('buttons')
    {!! add_button('timesheet.leave.add', 'new_leave_application') !!}
@endsection

@section('table')

    <table class="leave-application-pending table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.leave_type')}}</th>
            <th>{{trans('app.leave_for')}}</th>
            <th>{{trans('app.leave_days')}}</th>
            <th>{{trans('app.leave_hour')}}</th>
            <th>{{trans('app.approval_status')}}</th>
            @if(! is_employee())
                 <th>{{trans('app.action')}}</th>
            @endif
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

@endsection

@section('tableScript')
    @include('timesheet::scripts.script')
@endsection
