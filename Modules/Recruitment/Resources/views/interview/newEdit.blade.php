@extends('layouts.modal', ['title' => 'new_job', 'size' => 'lg'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="parent_id">
                    {{trans('app.job')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.job')}}"></i>
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
                <label class="col-form-label label-align" for="job_application_id">
                    {{trans('app.candidate')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.candidate')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="job_application_id" name="job_application_id" required>
                        @if(! empty($interview->application))
                            <option value="{{$interview->application->id}}" selected>{{$interview->application->name}}</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="interview_date">
                    {{trans('app.interview_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.interview_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="interview_date" class="form-control datePicker" type="text" name="interview_date"
                           value="@if($interview){{$interview->interview_date}}@endif" placeholder="{{trans('app.interview_date')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="interview_time">
                    {{trans('app.interview_time')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.interview_time')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="interview_time" class="form-control timePicker" type="text" name="interview_time"
                           value="@if($interview){{$interview->interview_time}}@endif" placeholder="{{trans('app.interview_time')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="interview_place">
                    {{trans('app.interview_place')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.interview_place')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="interview_place" class="form-control" type="text" name="address"
                           value="@if($interview){{$interview->address}}@endif" placeholder="{{trans('app.interview_place')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="employee_id">
                    {{trans('app.interviewers')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-ajax" multiple data-link="{{route('employee.getEmployee')}}" autofocus id="employee_id"
                            name="interviewers[]" required>
                        <option value="">{{trans('app.select')}}</option>
                        @if(! empty($interview->interviewers))
                            @foreach($interview->interviewers as $interviewer)
                                <option value="{{$interviewer->id}}" selected>{{$interviewer->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>


            @if($interview)
                {{--Status--}}
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="status">
                        {{trans('app.status')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.status')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" name="status" id="status">
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(config('recruitment.interview_status') as $status)
                                <option value="{{$status['key']}}"
                                    @if($interview)
                                        @if($status['key'] == $interview->status) selected @endif
                                    @endif> {{$status['value']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.job_details')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea id="details" class="form-control summernote" name="details" placeholder="{{trans('app.details')}}">@if($interview){!! json_decode($interview->details) !!}@endif</textarea>
                </div>
            </div>

        </div>
    </div>

@endsection

@include('recruitment::scripts.formScript')



