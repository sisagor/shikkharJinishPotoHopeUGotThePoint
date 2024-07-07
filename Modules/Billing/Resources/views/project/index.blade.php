@extends('layouts.tableTab', ['title' => 'projects'])

{{--if need custom button use this--}}
@section('buttons')
  {!! add_button('billing.project.add', 'new_project') !!}
@endsection

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.manager')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.details')}}</th>
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
            <th>{{trans('app.manager')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.details')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')
    @include('billing::scripts.project')
@endsection
