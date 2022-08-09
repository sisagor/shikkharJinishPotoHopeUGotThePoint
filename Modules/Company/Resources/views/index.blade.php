@extends('layouts.tableTab', ['title' => '', 'btnType' => 'modal'])

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.address')}}</th>
            <th>{{trans('app.role')}}</th>
            <th>{{trans('app.branches')}}</th>
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
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.address')}}</th>
            <th>{{trans('app.role')}}</th>
            <th>{{trans('app.branches')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')
    @include('company::scripts.script')
@endsection
