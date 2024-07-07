@extends('layouts.tableTab', ['title' => 'employees', 'filter' => 1])

@section('filter')
    <div class="col-md-3">
        <select class="form-control" name="department" id="department-filter">
            <option value="">{{trans('app.select_department')}}</option>
            @foreach(get_departments() as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select class="form-control" name="designation" id="designation-filter">
            <option value="">{{trans('app.select_designation')}}</option>
            @foreach(get_designations() as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>
@endsection


@section('buttons')

    @if(is_company_admin() && check_device_active("company"))
        <li><a href="javascript:void(0)" type="button" class="btn btn-warning ajax-modal-btn" data-link="{{route('employee.device.sync.com')}}"
           title="if take time reload after 60 second">
            {{trans('app.sync_with_device')}}</a>
        </li>
    @endif

    @if(is_branch_admin() && check_device_active("branch"))
        <li><a href="javascript:void(0)" type="button" class="btn btn-warning ajax-modal-btn" data-link="{{route('employee.device.sync.branch')}}"
           title="if take time reload after 60 second">
            {{trans('app.sync_with_device')}}</a>
        </li>
    @endif

    @if(config('company_settings.allow_bulk_upload'))
        <li><a href="javascript:void(0)" type="button" class="btn btn-warning ajax-modal-btn" data-link="{{route('employee.import')}}"
               title="if take time reload after 60 second">
                {{trans('app.bulk_upload')}}</a>
        </li>
    @endif

    {!! add_button('employee.employee.add', 'new_employee', 0) !!}

@endsection


@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>{{trans('app.index')}}</th>
            <th>{{trans('app.employee_id')}}</th>
            <th>{{trans('app.department')}}</th>
            <th>{{trans('app.designation')}}</th>
            <th>{{trans('app.employee_type')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th>{{trans('app.device_id')}}</th>
            <th>{{trans('app.status')}}</th>
            <th class="action-buttons">{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('trash')
    <table class="trash-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>{{trans('app.index')}}</th>
            <th>{{trans('app.employee_id')}}</th>
            <th>{{trans('app.department')}}</th>
            <th>{{trans('app.designation')}}</th>
            <th>{{trans('app.employee_type')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th>{{trans('app.device_id')}}</th>
            <th>{{trans('app.status')}}</th>
            <th class="action-buttons">{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')
    @include('employee::scripts.datatable')
@endsection
