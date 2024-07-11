@extends('layouts.tableTab', ['title' => 'blogs'])

{{--only for company properies--}}
@section('adminFilter')
@endsection
{{--End Section--}}

@section('buttons')
    {!! add_button('cms.blog.add', 'new_blog', 0) !!}
@endsection

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.category')}}</th>
            <th>{{trans('app.title')}}</th>
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
            <th>{{trans('app.category')}}</th>
            <th>{{trans('app.title')}}</th>
            <th>{{trans('app.details')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')

    @include('cms::scripts.blog')

@endsection
