@extends('layouts.modal', ['size' => 'md'])

@php
    $readonly = (is_company_admin() || is_branch_admin() ? " " : "readonly");
@endphp

@section('modal')
    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="parent_id">
                    {{trans('app.shift')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.select_shift')}}"></i>
                </label>
                <div class="item form-group">
                    <select type="text" class="form-control select2-dropdown" id="parent_id" name="shift_id"
                            data-child-id="employee_id"
                            data-link="{{route('componentSettings.getEmployeeViaShift')}}" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(get_shifts() as $id => $value)
                            <option value="{{ $id }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="employee_id">
                    {{trans('app.employees')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.click_to_select_employee')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-dropdown" multiple
                            id="employee_id" name="employee_id[]" required>
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 checkin">
                <label class="col-form-label label-align" for="checkin_time_real">
                    {{trans('app.punch_time')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.punch_time')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control @if(is_company_admin() || is_branch_admin()) timePicker @endif " id="checkin_time_real"
                           value="{{date('h:i A')}}" autocomplete="off" name="punch_time"
                           {{$readonly}} required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="attendance_date">
                    {{trans('app.attendance_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.attendance_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control @if(is_company_admin() || is_branch_admin()) datePicker @endif" value="{{date('Y-m-d')}}" id="attendance_date"
                           name="attendance_date" {{$readonly}} required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="attendance_date">
                    {{trans('app.attendance_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.attendance_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" value="{{date('Y-m-d')}}" id="attendance_date"
                           @if(! config('app.demo')) readonly @endif name="attendance_date" required/>
                </div>
            </div>

        </div>
    </div>

@endsection

@include('timesheet::scripts.formScript')
