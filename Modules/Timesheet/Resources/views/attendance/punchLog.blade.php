
@extends('layouts.table', ['title' => 'punch_log',  'filter' => 1])


@section('buttons')

    @if(config('app.demo'))
        @if(! is_employee())
            {!! add_button('timesheet.attendance.add', 'new_punch') !!}
        @endif
    @endif

@endsection


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

@section('table')
    <table class="punchLog-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.device_ip')}}</th>
            <th>{{trans('app.punch_time')}}</th>
            <th>{{trans('app.date')}}</th>
            <th>{{trans('app.location')}}</th>
           <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('tableScript')
    @include('timesheet::scripts.script')

    @if($attType == \Modules\Company\Entities\CompanySetting::ATTENDANCE_IP)
        <script>
            //$('#new_punch').addClass('hide');
        </script>
       {{-- <style> #new_punch{display: none!important;}</style>--}}
    @endif
@endsection
