@extends('layouts.tableTab', ['title' => 'contact-us'])

{{--only for company properies--}}
{{--End Section--}}

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.name')}}</th>
            <th>{{trans('app.email')}}</th>
            <th>{{trans('app.phone')}}</th>
            <th>{{trans('app.message')}}</th>
        </tr>
        </thead>
        <tbody>
            {{-- @php $i=1; @endphp
            @foreach ($data as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->mobile}}</td>
                    <td>{{$item->message}}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
@endsection

@section('tableTabScript')

    @include('cms::scripts.contact')

@endsection

