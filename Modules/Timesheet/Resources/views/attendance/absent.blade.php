@extends('layouts.report', ['title' => 'absent_log', 'filter' => 1])

@section('filter')
   {{-- @if(! is_employee())
        <div class="col-md-2">
            <select class="form-control select2-ajax" data-text="{{trans('help.search_employee')}}"
                    data-link="{{route('employee.getEmployee')}}" name="employee" id="employee-filter">
                <option value="">{{trans('app.select_employee')}}</option>
            </select>
        </div>
    @endif--}}

    {!! date_filter_filed(5) !!}

@endsection

{{--@section('button')
    <button class="btn btn-warning">{{trans('app.review')}}</button>
@endsection--}}

@section('report')
    <table class="attendance-absent table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.attendance_date')}}</th>
            <th>{{trans('app.status')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('reportScript')
    @include('timesheet::scripts.script')
@endsection
