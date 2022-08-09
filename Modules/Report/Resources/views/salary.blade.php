@extends('layouts.report', ['title' => 'salaries', 'filter' => 1])


@section('filter')

    {!! month_search_filed(2) !!}

@endsection

@section('report')
    <table class="salary-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.first_name')}}</th>
            <th>{{trans('app.last_name')}}</th>
            <th>{{trans('app.salary_month')}}</th>
            <th>{{trans('app.basic_salary')}}</th>
            <th> {{trans('app.allowance')}}</th>
            <th>{{trans('app.deduction')}}</th>
            <th>{{trans('app.other_allowance')}}</th>
            <th>{{trans('app.other_deduction')}}</th>
            <th>{{trans('app.total')}}</th>
            <th>{{trans('app.paid_amount')}}</th>
            <th>{{trans('app.due_amount')}}</th>
            <th>{{trans('app.status')}}</th>
            {{-- <th class="action-buttons">{{trans('app.action')}}</th>--}}
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('reportScript')
    @include('report::scripts.script')
@endsection
