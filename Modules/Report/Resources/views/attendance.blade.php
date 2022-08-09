@extends('layouts.report', ['title' => 'attendances', 'filter' => 1])

@section('filter')

    <div class="col-md-2">
        <select  class="form-control w-100" data-text="{{trans('help.status')}}"
               name="status" id="status-filter">
            <option value="">{{trans('app.select_status')}}</option>
            <option value="{{\App\Models\RootModel::PRESENT}}">{{trans('app.present')}}</option>
            <option value="{{\App\Models\RootModel::ABSENT}}">{{trans('app.absent')}}</option>
        </select>
    </div>

  {{--  @if(! is_employee())
        <div class="col-md-2">
            <select style="width: 100%" class="form-control select2-ajax" data-text="{{trans('help.search_employee')}}"
                    data-link="{{route('employee.getEmployee')}}" name="employee" id="employee-filter">
                <option value="">{{trans('app.select_employee')}}</option>
            </select>
        </div>
    @endif--}}

    {!! date_filter_filed(4) !!}

@endsection

{{--@section('button')
    <button class="btn btn-warning">{{trans('app.review')}}</button>
@endsection--}}

@section('report')
    <table class="report-attendance-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.first_name')}}</th>
            <th>{{trans('app.last_name')}}</th>
            <th>{{trans('app.machine_ip')}}</th>
            <th>{{trans('app.checkin_time')}}</th>
            <th>{{trans('app.checkout_time')}}</th>
            <th>{{trans('app.attendance_date')}}</th>
            <th>{{trans('app.working_hour')}}</th>
            <th>{{trans('app.late')}}</th>
            <th>{{trans('app.overtime')}}</th>
            <th>{{trans('app.status')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('reportScript')
    @include('report::scripts.script')
@endsection
