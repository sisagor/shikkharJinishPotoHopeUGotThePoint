@extends('layouts.form')
@php
    $json = json_decode($email?->details);
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
                    <input class="form-control timePicker" name="delivery_time" id="time" value="@if(! empty($email)){!! $email->delivery_time !!}@endif">
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
                            <option value="{{$key}}" @if(! empty($email) && $email->delivery_type == $key) selected @endif>{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="emails">
                    {{trans('app.emails')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.emails')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" name="emails" id="emails" placeholder="insert emails separate by comma (,) ex: admin@demo.com, user@demo.com">@if(! empty($json)) {!! $json->emails !!} @endif</textarea>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="subject">
                    {{trans('app.subject')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.subject')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" name="subject" id="subject" placeholder="insert subject here" value="@if(! empty($json)){!! $json->subject !!}@endif">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="body">
                    {{trans('app.body')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.body')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="body" name="body" required> @if(! empty($json)){!! $json->body !!}@endif </textarea>
                </div>
            </div>

        </div>
    </div>

@endsection

{{--@include('notification::scripts.formScript')--}}
