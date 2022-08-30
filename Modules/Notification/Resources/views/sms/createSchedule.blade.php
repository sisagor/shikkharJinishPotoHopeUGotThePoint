@extends('layouts.form')
@php
    $json = json_decode($sms?->details);
    //dd($json);
@endphp
@section('form')
    <div class="form-body">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="schedule_time">
                    {{trans('app.schedule_time')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.schedule_time')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control timePicker" name="delivery_time" id="time" value="@if(! empty($sms)) {!! \Carbon\Carbon::parse($sms->delivery_time)->format('h:i A') !!} @endif">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="schedule_type">
                    {{trans('app.schedule_type')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.click_to_select_department')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="delivery_type" id="schedule_type">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(config('notification.schedule') as $key => $item)
                            <option value="{{$key}}" @if(! empty($sms) && $sms->delivery_type == $key)selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="phone_numbers">
                    {{trans('app.phone_numbers')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.phone_numbers')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" name="numbers" id="numbers" placeholder="insert numbers separate by comma (,) ex: +8801715....45, +8801826....56">@if(! empty($json)) {!! $json->numbers !!} @endif</textarea>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="body">
                    {{trans('app.sms_body')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.sms_body')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control"  id="body" name="body" required> @if(! empty($json)){!! $json->body !!}@endif </textarea>
                </div>
            </div>

        </div>
    </div>

@endsection

{{--@include('notification::scripts.formScript')--}}
