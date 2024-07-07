@extends('layouts.modal', ['size' => 'md'])
@php
    //dd(get_employee_leaveTypes())
@endphp

@section('modal')

    <div class="form-body">
        <div class="row">
            @php
               //use Illuminate\Support\Carbon;
               $periods = now()->subMonths(12)->monthsUntil(now()->subMonth());
            @endphp

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="salary_month">
                    {{trans('app.salary_month')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.select_month')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="salary_month" name="salary_month" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($periods as $period)
                            <option value="{{$period}}">{{$period->format('Y-F')}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="employee_id">
                    {{trans('app.employee_or_left_if_all')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.select_employee')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-ajax" data-link="{{route('employee.getEmployee')}}" autofocus id="employee_id"
                            name="employee[]"  multiple>
                        <option value="">All</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection



