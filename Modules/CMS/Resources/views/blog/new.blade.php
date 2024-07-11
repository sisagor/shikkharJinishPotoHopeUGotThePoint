@extends('layouts.form', ['title' => 'new_blog'])

@section('form')

    <div class="form-body">
        <div class="row">

            <div class="col-md-4 col-sm-4">
                <label class="col-form-label label-align" for="parent_id">
                    {{trans('app.category')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.category')}}"></i>
                </label>
                {{--<div class="item form-group">
                    <select class="form-control" data-link="{{route('recruitment.application.ajax')}}"
                            data-child-id="job_application_id" id="parent_id" name="job_id" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($jobs as $id => $name)
                            <option value="{{ $id }}" @if(! empty($blog))@if($blog->job_id == $id) selected @endif @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>  --}}
                <div class="item form-group">
                    <select class="form-control" name="category_id" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" @if(! empty($blog))@if($blog->category_id == $id) selected @endif @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.title')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.title')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="title" name="title" required placeholder="{{trans('app.title')}}">
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-4 col-sm-4">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        @foreach(config('status.status') as $key => $item)
                            <option value="{{$key}}">{{$item}} </option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="image">
                    {{trans('app.image')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.image')}}"></i>
                </label>
                <div class="item form-group">
                    <input type="file" class="form-control" id="image" name="image[]" required placeholder="{{trans('app.image')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.details')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="details" name="details[]" required placeholder="{{trans('app.details')}}">
                </div>
            </div>

        </div>
    </div>

@endsection

@include('cms::scripts.formScript')



