@extends('layouts.report', ['title' => 'attendances', 'filter' => 1, 'filterLeft' => 1])

@section('filter')
    {!! month_search_filed(3) !!}
@endsection

{{--@section('button')
    <button class="btn btn-warning">{{trans('app.review')}}</button>
@endsection--}}

@section('report')
    <table class="report-attendance-month-wise-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>{{trans('app.id')}}</th>
            <th>{{trans('app.name')}}</th>

            @for($i = 1; $i <= $days; $i++)
                 <th>{{$i}}</th>
            @endfor

            <th>{{trans('app.p')}}</th>
            <th>{{trans('app.holiday_leave')}}</th>
            <th>{{trans('app.a')}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('reportScript')

    <script>
        $('#month-filter').on('change', function () {
            return window.location = '?month=' + $('#month-filter').val();
        });
    </script>

    @include('report::scripts.script')
@endsection
