@extends('layouts.modal', ['size' => 'md'])

@section('modal')
    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="employee_id">
                    {{trans('app.employee')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.checkout_time')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" value="{{$att->employee_index}}" readonly id="employee_id">
                </div>
            </div>

            {{-- <div class="col-md-12 col-sm-12">
                 <label class="col-form-label label-align" for="checkin_time">
                     {{trans('app.checkin_time')}}
                 </label>
                 <div class="item form-group">
                     <input class="form-control" type="text" readonly value="{{date('h:i A', strtotime($att->checkin_time))}}" id="checkin_time"
                            required/>
                 </div>
             </div>--}}

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="checkout_time">
                    {{trans('app.shift_checkout_time')}}
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text"
                           @if($att->employee->shift->end_time)
                           value="{{date('h:i A', strtotime($att->employee->shift->end_time))}}"
                           @endif
                           id="checkout_time" disabled/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 checkout">
                <label class="col-form-label label-align" for="checkout_time">
                    {{trans('app.checkout_time')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.checkout_time')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control timePicker"
                           @if($att->employee->shift->end_time)
                           value="{{date('h:i A', strtotime($att->employee->shift->end_time))}}"
                           @endif type="text" id="checkout_time" name="checkout_time"
                           required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="checkout_date">
                    {{trans('app.checkout_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.attendance_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" value="{{date('Y-m-d')}}" id="checkout_date"
                           @if(! config('app.demo')) readonly @endif name="checkout_date" required/>
                </div>
            </div>

        </div>
    </div>

@endsection
