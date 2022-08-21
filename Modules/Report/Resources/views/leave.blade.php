@extends('layouts.table', ['title' => 'leave_applications', 'btnType' => 'modal', 'filter' => 1])

@section('filter')
    <div class="col-md-2">
        <select  class="form-control w-100" data-text="{{trans('help.status')}}"
                 name="status" id="status-filter">
            <option value="">{{trans('app.select_status')}}</option>
            <option value="{{\App\Models\RootModel::APPROVAL_STATUS_APPROVED}}">{{trans('app.approved')}}</option>
            <option value="{{\App\Models\RootModel::APPROVAL_STATUS_REJECTED}}">{{trans('app.rejected')}}</option>
        </select>
    </div>

  {!! date_filter_filed(5) !!}
@endsection

@section('table')

    <table class="leave-application table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.leave_type')}}</th>
            <th>{{trans('app.start_date')}}</th>
            <th>{{trans('app.end_date')}}</th>
            <th>{{trans('app.leave_days')}}</th>
            <th>{{trans('app.details')}}</th>
            <th>{{trans('app.approval_status')}}</th>
            <th>{{trans('app.approved_by')}}</th>

        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

@endsection

@section('tableScript')
    @include('report::scripts.script')
@endsection
