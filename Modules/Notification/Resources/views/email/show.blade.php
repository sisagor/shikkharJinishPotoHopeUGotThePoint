@extends('layouts.viewModal', ['size' => 'lg', 'title'=> 'view_email'])

@section('viewModal')
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="to_email">
                    {{trans('app.to_email')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.subject')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" name="to_email" readonly id="to_email" placeholder="insert subject here" value="@if(!empty($email->email)){!! $email->email !!}@endif">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="subject">
                    {{trans('app.subject')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.subject')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" readonly name="subject" id="subject" value="@if(! empty($email->subject)) {!! $email->subject !!}@endif" >
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="body">
                    {{trans('app.body')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.body')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" readonly id="body" name="body" required>@if(! empty($email->body)){!! json_decode($email->body) !!}@endif</textarea>
                </div>
            </div>

        </div>
    </div>

@endsection

{{--@include('notification::scripts.formScript')--}}
