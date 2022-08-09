@extends('layouts.table', ['title' => 'salary_structure_components', 'btnType' => 'modal'])

@section('table')
    <table class="default-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
            <tr>
                <th>#</th>
                @if(is_super_admin())
                    <th>{{trans('app.belongs_to')}}</th>
                @endif
                <th>{{trans('app.type')}}</th>
                <th>{{trans('app.name')}}</th>
                <th>{{trans('app.status')}}</th>
                <th>{{trans('app.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($structures as $key => $item)
                <tr>
                    <td>{{  $key + 1 }}</td>
                    @if(is_super_admin())
                        <td>@if($item->company){{ $item->company->name }}@endif</td>
                    @endif
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ get_status($item->status)}}</td>
                    <td>
                        {!! edit_button($item, 'modal') !!} {!! delete_button($item) !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
