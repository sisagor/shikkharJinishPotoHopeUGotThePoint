@extends('layouts.modal', ['title' => 'new_offer', 'size' => 'lg'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="parent_id">
                    {{trans('app.job_application')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.job_application')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" data-link="{{route('recruitment.application.ajax')}}"
                            data-child-id="job_application_id" id="parent_id" name="job_id" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($jobs as $id => $name)
                            <option value="{{ $id }}" @if(! empty($interview))@if($interview->job_id == $id) selected @endif @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="name" class="form-control" type="text" name="name" readonly
                           value="@if($application){{$application->name}}@endif" placeholder="{{trans('app.name')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="email">
                    {{trans('app.email')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="email" class="form-control" type="text" name="email" readonly
                           value="@if($application){{$application->email}}@endif" placeholder="{{trans('app.email')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="phone">
                    {{trans('app.phone')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="phone" class="form-control" type="text" name="phone" readonly
                           value="@if($application){{$application->phone}}@endif" placeholder="{{trans('app.phone')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="expected_salary">
                    {{trans('app.expected_salary')}}
                </label>
                <div class="item form-group">
                    <input id="expected_salary" class="form-control" type="number" step="0.01" name="expected_salary" readonly
                           value="@if($application){{$application->expected_salary}}@endif" placeholder="{{trans('app.expected_salary')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="resume">
                    {{trans('app.resume')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    {{-- <input id="resume"  class="fa fa-file" type="file"  name="resume" placeholder="{{trans('app.resume')}}">--}}
                    <a target="_blank" href="{{(get_file_url(optional($application->document)->path))}}" download>{{trans('app.download_resume')}}</a>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.status')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(config('recruitment.app_status') as $status)
                            <option value="{{$status['key']}}"
                                    @if($application)
                                    @if($status['key'] == $application->status) selected @endif
                                @endif> {{$status['value']}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="cover_later">
                    {{trans('app.cover_later')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <textarea id="cover_later" class="form-control summernote" name="cover_later"
                              placeholder="{{trans('app.cover_later')}}">@if($application){{json_decode($application->cover_later)}}@endif</textarea>
                </div>
            </div>


        </div>
    </div>

@endsection

@include('recruitment::scripts.formScript')



