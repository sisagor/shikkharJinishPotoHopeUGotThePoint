@extends('frontEnd.layouts.app')

@section('contents')

    @if(! empty($home->content))
        {!!  json_decode($home->content) !!}
    @endif

@endsection




