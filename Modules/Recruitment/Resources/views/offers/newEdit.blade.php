@extends('layouts.modal', ['title' => 'new_offer', 'size' => 'lg'])

@section('modal')

    <div class="showNotification"></div>

    <div class="row">
        <div class="form-body">

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="parent_id">
                    {{trans('app.job')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.job')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" data-link="{{route('recruitment.offer.ajax')}}"
                            data-child-id="job_application_id" id="parent_id" name="job_id" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($jobs as $id => $name)
                            <option value="{{ $id }}" @if(! empty($offer))@if($offer->job_id == $id) selected @endif @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="job_application_id">
                    {{trans('app.candidate')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.candidate')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="job_application_id" name="job_application_id" required>
                        @if(! empty($offer->application))
                            <option value="{{$offer->application->id}}" selected>{{$offer->application->name}}</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="experience">
                    {{trans('app.title')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.title')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="title" class="form-control" type="text" name="title"
                           value="@if($offer){{$offer->title}}@endif" placeholder="{{trans('app.title')}}">
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.offer_details')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.job_offer_details')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea id="offer_details" class="form-control summernote" name="offer_details" placeholder="{{trans('app.offer_details')}}">@if($offer){!! json_decode($offersss->offer_details) !!}@endif</textarea>
                </div>
            </div>


        </div>
    </div>

@endsection

@include('recruitment::scripts.formScript')



