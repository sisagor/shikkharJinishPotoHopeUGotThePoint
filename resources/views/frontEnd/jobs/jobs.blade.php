@extends('frontEnd.layouts.app')

<style>
    .jumbotron {
        padding: 1rem 2rem!important;
    }
</style>

@section('contents')
@include('frontEnd.header', ['title' => "Jobs"])

@php

   // dd();

@endphp

<div style="padding: 50px 50px 50px 50px;">

    <div class="col-md-12 col-sm-12 col-12">

        <div class="col-md-8 col-sm-8 col-12">

            <div class="x_content">
                <div class="bs-example" data-example-id="simple-jumbotron">

                    @foreach($jobs as $job)

                            <div class="jumbotron">
                                <a href="{{route('job.show', $job->id)}}"> <h2>{{$job->position}}</h2> </a>
                                <p>{!!  json_decode($job->details) !!}</p>
                                <p><strong>{{trans('app.job_location')}} : </strong>{!!  $job->job_location !!}</p>
                                <p><strong>{{trans('app.salary_rang')}} : </strong>{!!  $job->salary_rang !!}</p>
                                <p><strong>{{trans('app.status')}} : </strong>{!!  $job->status !!}</p>
                            </div>

                    @endforeach

                </div>
            </div>


        </div>


        @include('frontEnd.jobs.category')

    </div>
</div>




@endsection
