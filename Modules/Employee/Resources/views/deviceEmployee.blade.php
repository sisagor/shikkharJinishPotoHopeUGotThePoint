@extends('layouts.table', ['title' => 'employees', 'filter' => 1, 'customBtn' => 1])


@section('customBtn')
    <a href="javascript:void(0)" type="button" class="btn btn-warning ajax-modal-btn" data-link="{{route('employee.device.sync')}}"
    title="if take time reload after 60 second">
        {{trans('app.sync_with_device')}}</a>
@endsection

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


@section('table')
    <table class="employee-table table table-striped table-bordered no-footer dtr-inline w-100"
          role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>{{trans('app.index')}}</th>
            <th>{{trans('app.employee_id')}}</th>
            <th>{{trans('app.department')}}</th>
            <th>{{trans('app.designation')}}</th>
            <th>{{trans('app.employee_type')}}</th>
            <th>{{trans('app.first_name')}}</th>
            <th>{{trans('app.last_name')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th class="action-buttons">{{trans('app.action')}}</th>

        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableScript')
    @include('employee::scripts.datatable')
@endsection
