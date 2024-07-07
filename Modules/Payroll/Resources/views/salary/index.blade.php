@extends('layouts.table', ['title' => 'pending_salaries', 'filter' => 1, 'btnType' => 'modal'])


@section('filter')
   {{--{!! employee_search_filed(3) !!}--}}
   {!! month_search_filed(3) !!}
@endsection

@section('buttons')
    {!! add_button('payroll.salaryGenerate', 'generate_salary') !!}
@endsection

@section('table')
    <table class="salary-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.salary_month')}}</th>
            <th>{{trans('app.basic_salary')}}</th>
            <th>{{trans('app.allowance')}}</th>
            <th>{{trans('app.deduction')}}</th>
            <th>{{trans('app.total')}}</th>
            <th class="action-buttons">{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('tableScript')
    @include('payroll::scripts.script')
@endsection
