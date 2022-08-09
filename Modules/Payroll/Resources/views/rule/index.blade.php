@extends('layouts.table', ['title' => 'salary_rules'])

@section('table')
    {{--<table class="default-table table table-striped table-bordered no-footer dtr-inline"
           style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">--}}
        <table id="datatable" class="default-table table table-striped table-bordered w-100">
        <thead>
            <tr>
                <th>#</th>
                @if(is_super_admin())
                    <th>{{trans('app.belongs_to')}}</th>
                @endif
                <th>{{trans('app.name')}}</th>
                <th>{{trans('app.designation')}}</th>
                <th>{{trans('app.basic_salary')}}</th>
                <th>{{trans('app.details')}}</th>
                <th>{{trans('app.status')}}</th>
                <th class="action-buttons">{{trans('app.action')}}</th>

            </tr>
        </thead>
        <tbody>
            @foreach($rules as $key => $item)
                <tr>
                    <td>{{  $key + 1 }}</td>
                    @if(is_super_admin())
                        <td>@if($item->company){{ $item->company->name }}@endif</td>
                    @endif
                    <td>{{ $item->name }}</td>
                    <td>@if($item->designation){{ $item->designation->name }}@endif</td>
                    <td>{{ get_formatted_currency($item->basic_salary) }}</td>
                    <td>{{ $item->details }}</td>
                    <td>{{ get_status($item->status)}}</td>
                    <td>
                        {!! view_button($item, 'modal')!!} {!! edit_button($item) !!} {!! delete_button($item) !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
