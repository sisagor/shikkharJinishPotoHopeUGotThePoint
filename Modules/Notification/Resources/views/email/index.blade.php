@extends('layouts.table', ['title' => 'email_log', 'filter' => 1])


@section('filter')
    {{-- <div class="col-md-3">
         <select class="form-control select2-ajax" data-text="{{trans('help.search_employee')}}"
                 data-link="{{route('employee.getEmployee')}}" name="employee" id="employee-filter">
             <option value="">{{trans('app.select_employee')}}</option>
         </select>
     </div>--}}
   {{-- <div class="col-md-3">
        @php
            use Illuminate\Support\Carbon;
            $period = now()->subMonths(12)->monthsUntil(now());
        @endphp
        <select class="form-control" name="month" id="month-filter">
            <option value="">{{trans('app.select_month')}}</option>
            @foreach($period as $date)
                <option value="{{ $date->format('Y-m') }}">{{ $date->format('F-Y') }}</option>
            @endforeach
        </select>
    </div>--}}
@endsection

@section('buttons')
    {!! add_button('notification.email.add', 'send_email') !!}
@endsection

@section('table')
    <table class="email-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.subject')}}</th>
            <th>{{trans('app.body')}}</th>
            <th>{{trans('app.sent_at')}}</th>
            <th>{{trans('app.status')}}</th>
            <th class="action-buttons">{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('tableScript')
    @include('notification::scripts.script')
@endsection