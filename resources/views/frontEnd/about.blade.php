@extends('frontEnd.layouts.app')

@section('contents')

    @include('frontEnd.header', ['title' => "About us"])

    {!! (! empty($about->content) ? json_decode($about->content) : null)  !!}

@endsection
