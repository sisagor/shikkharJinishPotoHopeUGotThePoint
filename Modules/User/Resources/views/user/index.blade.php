@extends('layouts.tableTab', ['title' => 'users', 'btnType' => 'modal', 'filter' => 1])

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.department')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.role')}}</th>
            <th>{{trans('app.access_level')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('trash')
    <table class="trash-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.department')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.role')}}</th>
            <th>{{trans('app.access_level')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')
    @include('user::scripts.user')
@endsection
