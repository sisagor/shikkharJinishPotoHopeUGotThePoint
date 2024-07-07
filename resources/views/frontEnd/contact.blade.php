@extends('frontEnd.layouts.app')

@section('contents')

    @include('frontEnd.header', ['title' => "Contact us"])

    {!! (! empty($contact->content) ? json_decode($contact->content) : null)  !!}

@endsection
