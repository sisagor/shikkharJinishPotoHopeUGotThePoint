@extends('layouts.tableTab', ['title' => 'books'])

{{--only for company properies--}}
@section('adminFilter')
@endsection
{{--End Section--}}

@section('buttons')
    {!! add_button('cms.book.add', 'new_book', 1) !!}
@endsection

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.image')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.url')}}</th>
            <th>{{trans('app.order')}}</th>
            <th>{{trans('app.view')}}</th>
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
            <th>{{trans('app.image')}}</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.url')}}</th>
            <th>{{trans('app.order')}}</th>
            <th>{{trans('app.view')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')

    @include('cms::scripts.book')

@endsection
