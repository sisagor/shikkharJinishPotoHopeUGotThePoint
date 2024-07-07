@extends('layouts.tableTab', ['title' => 'pending_loans', 'btnType' => 'modal'])

{{--only for company properies--}}
@section('adminFilter')
    @if(is_admin_group())
        <div class="row">
            <div class="filter-box mb-2">
                <div class="col-md-1">
                    <strong class="font25">{{trans('app.filter')}}</strong>
                </div>
                <div class="col-md-11 col-sm-11 col-12">
                    <div class="col-md-4 col-sm-4 col-12">
                        <select class="form-control" name="company" id="company-filter">
                            <option value="">{{trans('app.select_company')}}</option>
                            @foreach(get_companies() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
{{--End Section--}}

@section('active')
    <table class="pending-loan-active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.employee_name')}}</th>
            <th>{{trans('app.type')}}</th>
            <th>{{trans('app.interest_percent')}}</th>
            <th>{{trans('app.loan_amount')}}</th>
            <th>{{trans('app.installments')}}</th>
            <th>{{trans('app.installment_amount')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>

        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('trash')
    <table class="pending-loan-trash-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.employee_index')}}</th>
            <th>{{trans('app.employee_name')}}</th>
            <th>{{trans('app.type')}}</th>
            <th>{{trans('app.interest_percent')}}</th>
            <th>{{trans('app.loan_amount')}}</th>
            <th>{{trans('app.installments')}}</th>
            <th>{{trans('app.installment_amount')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')

    @include('loan::scripts.scripts')
@endsection
