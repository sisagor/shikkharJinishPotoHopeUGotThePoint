@extends('frontEnd.layouts.app')

<style>
    .jumbotron {
        padding: 1rem 2rem!important;
    }
</style>

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

                    <div class="jumbotron">
                        <h1>{{$job->position}}</h1>
                        <p>{!!  json_decode($job->details) !!}</p>
                        <p>{!!  json_decode($job->requirements) !!}</p>
                        <p><strong>{{trans('app.job_location')}} : </strong>{!!  $job->job_location !!}</p>
                        <p><strong>{{trans('app.salary_rang')}} : </strong>{!!  $job->salary_rang !!}</p>
                        <p><strong>{{trans('app.status')}} : </strong>{!!  $job->status !!}</p>
                        <p><strong>{{trans('app.last_date')}} : </strong>{!!  $job->expire_date !!}</p>

                        @if($job->status == \Modules\Recruitment\Entities\Job::STATUS_OPEN)
                            <a class="btn btn-success" href="{{route('job.apply', $job->id)}}">{{trans('app.apply')}}</a>
                        @endif

                    </div>

                </div>
            </div>


        </div>


     @include('frontEnd.jobs.category')

    </div>
</div>




@endsection
