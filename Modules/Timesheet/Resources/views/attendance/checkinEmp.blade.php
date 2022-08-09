@extends('layouts.modal', ['size' => 'md'])

@section('modal')
    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12" >
                <div class="item form-group">
                    <label class="col-form-label label-align" for="checkin_time">
                        <strong>{{trans('app.shift_checkin_time')}}</strong> :
                        <span id="checkin_time">{{$shift->start_time}} </span> &nbsp;&nbsp;
                    </label>

                    <label class="col-form-label label-align" for="checkout_time">
                       <strong> {{trans('app.shift_checkout_time')}}</strong> :
                        <span id="checkout_time"> {{$shift->end_time}}</span> &nbsp;&nbsp;
                    </label>
                </div>

            </div>

            <input type="hidden" value="{{is_employee()}}" name="employee_id[]">

            <div class="col-md-12 col-sm-12 checkin">
                <label class="col-form-label label-align" for="checkin_time_real">
                    {{trans('app.punch_time')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.punch_time')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control  @if(config('app.demo')) timePicker @endif " id="checkin_time_real"
                           value="{{date('h:i A')}}"  @if(! config('app.demo')) readonly @endif
                           autocomplete="off" name="punch_time" required/>
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
