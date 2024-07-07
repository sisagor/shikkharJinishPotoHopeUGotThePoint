@extends('layouts.tableTab', ['title' => 'salary_rules'])


@section('buttons')
    {!! add_button('payroll.rule.add', 'new_salary_rule', 0) !!}
@endsection

@section('active')
    {{--<table class="default-table table table-striped table-bordered no-footer dtr-inline"
           style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">--}}
        <table id="datatable" class="active-table table table-striped table-bordered w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>{{trans('app.grade')}}</th>
                <th>{{trans('app.designation')}}</th>
                <th>{{trans('app.basic_salary')}}</th>
                <th>{{trans('app.details')}}</th>
                <th>{{trans('app.status')}}</th>
                <th class="action-buttons">{{trans('app.action')}}</th>

            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('trash')
    {{--<table class="default-table table table-striped table-bordered no-footer dtr-inline"
           style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">--}}
        <table id="datatable" class="trash-table table table-striped table-bordered w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>{{trans('app.grade')}}</th>
                <th>{{trans('app.designation')}}</th>
                <th>{{trans('app.basic_salary')}}</th>
                <th>{{trans('app.details')}}</th>
                <th>{{trans('app.status')}}</th>
                <th class="action-buttons">{{trans('app.action')}}</th>

            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')
    @include('payroll::scripts.rule')
@endsection
