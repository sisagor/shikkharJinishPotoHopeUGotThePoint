@extends('frontEnd.layouts.app')

@section('contents')

    {!!  json_decode($home->content) !!}

@endsection




