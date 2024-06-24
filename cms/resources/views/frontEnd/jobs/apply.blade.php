@extends('frontEnd.layouts.app')

@section('contents')

@include('frontEnd.header', ['title' => "Jobs"])

@php
  //dd(request()->segment(1));
@endphp

<div style="padding: 50px 50px 50px 50px;">

    <div class="col-md-12 col-sm-12 col-12">

        <div class="col-md-8 col-sm-8 col-12">

            <div class="x_content">
                <div class="bs-example" data-example-id="simple-jumbotron">

                    <div class="showNotification"></div>

                    <div class="jumbotron">
                        <h1>{{$job->position}}</h1>

                        <form method="post" enctype="multipart/form-data" action="{{ route('job.apply.store', $job->id)}}">
                            @csrf
                            <div class="clearfix"></div>
                            {{--Form content--}}

                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="name">
                                            {{trans('app.name')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <input id="name" class="form-control" type="text" name="name" placeholder="{{trans('app.name')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="email">
                                            {{trans('app.email')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <input id="email" class="form-control" type="text" name="email" placeholder="{{trans('app.email')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="phone">
                                            {{trans('app.phone')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <input id="phone" class="form-control" type="text" name="phone" placeholder="{{trans('app.phone')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="expected_salary">
                                            {{trans('app.expected_salary')}}
                                        </label>
                                        <div class="item form-group">
                                            <input id="expected_salary" class="form-control" type="number" step="0.01" name="expected_salary" placeholder="{{trans('app.expected_salary')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="resume">
                                            {{trans('app.resume')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <input id="resume"  class="fa fa-file" type="file"  name="resume" placeholder="{{trans('app.resume')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-12 col-sm-12">
                                        <label class="col-form-label label-align" for="cover_later">
                                            {{trans('app.cover_later')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <textarea id="cover_later" class="form-control summernote" name="cover_later" placeholder="{{trans('app.cover_later')}}"></textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            {{--End Form content--}}

                            <div class="clearfix"></div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-5 form-padding">
                                        <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                                                value="1" class="btn btn-primary">{{trans('app.apply')}}
                                        </button>
                                        <button type="reset" id="resetButton" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>


        </div>

     @include('frontEnd.jobs.category')

    </div>
</div>


@endsection

@section('scripts')
    @include('frontEnd.scripts.script')
@endsection
