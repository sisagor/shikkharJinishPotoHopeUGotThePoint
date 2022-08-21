@extends('layouts.tableTab', ['title' => 'salary_structure_components'])

@section('buttons')
    {!! add_button('payroll.structure.add', 'new_salary_structure') !!}
@endsection

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
            <tr>
                <th>#</th>
                <th>{{trans('app.type')}}</th>
                <th>{{trans('app.name')}}</th>
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
                <th>{{trans('app.type')}}</th>
                <th>{{trans('app.name')}}</th>
                <th>{{trans('app.status')}}</th>
                <th>{{trans('app.action')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScripts')
    @include('payroll::scripts.structure')
@endsection
