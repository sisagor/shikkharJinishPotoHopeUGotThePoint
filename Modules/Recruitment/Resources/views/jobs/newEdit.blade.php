@extends('layouts.modal', ['title' => 'new_job', 'size' => 'lg'])

@section('modal')

    <div class="showNotification"></div>

    <div class="row">
        <div class="form-body">
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="category_id">
                    {{trans('app.job_category')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.job_category')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-dropdown" name="category_id" id="category_id" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($jobCategory as $category)
                            <option value="{{$category->id}}"
                                    @if($job && $category)
                                    @if($category->id == $job->category_id) selected @endif
                                @endif> {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="position">
                    {{trans('app.position')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.position')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="position" class="form-control" type="text" name="position"
                           value="@if($job){{$job->position}}@endif" placeholder="{{trans('app.position')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="experience">
                    {{trans('app.experience')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.experience')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="experience" class="form-control" type="text" name="experience"
                           value="@if($job){{$job->experience}}@endif" placeholder="{{trans('app.experience')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="vacancy">
                    {{trans('app.vacancy')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.vacancy')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="vacancy" class="form-control" type="text" name="vacancy"
                           value="@if($job){{$job->vacancy}}@endif"  placeholder="{{trans('app.vacancy')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="job_location">
                    {{trans('app.job_location')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.job_location')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="job_location" class="form-control" type="text" name="job_location"
                           value="@if($job){{$job->job_location}}@endif"  placeholder="{{trans('app.job_location')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="salary_rang">
                    {{trans('app.salary_rang')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.salary_rang')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="salary_rang" class="form-control" type="text" name="salary_rang"
                           value="@if($job){{$job->salary_rang}}@endif"  placeholder="{{trans('app.salary_rang')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="expire_date">
                    {{trans('app.expire_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.expire_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="expire_date"  class="form-control datePicker" type="text"  name="expire_date"
                           value="@if($job){{\Carbon\Carbon::parse($job->expire_date)->format('Y-m-d')}}@endif" placeholder="{{trans('app.expire_date')}}">
                </div>
            </div>

            @if($job)
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
                            @foreach(config('recruitment.job_status') as $status)
                                <option value="{{$status['key']}}"
                                    @if($job)
                                        @if($status['key'] == $job->status) selected @endif
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
                    <textarea id="details" class="form-control summernote" name="details" placeholder="{{trans('app.details')}}">@if($job){!! json_decode($job->details) !!}@endif</textarea>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="requirements">
                    {{trans('app.requirements')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.requirements')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea id="requirements" class="form-control summernote" name="requirements" placeholder="{{trans('app.requirements')}}">@if($job){!! json_decode($job->requirements) !!}@endif</textarea>
                </div>
            </div>

        </div>
    </div>

@endsection

@include('recruitment::scripts.formScript')



