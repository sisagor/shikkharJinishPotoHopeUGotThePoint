@extends('layouts.tableTab', ['title' => 'job_posting'])

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

@section('buttons')
    {!! add_button('recruitment.jobPosting.add', 'new_job') !!}
    <li><a class="btn btn-secondary" target="_blank" href="{!! route('jobs') !!}"> <i class="fa fa-globe"></i> {{trans('app.cms')}}</a></li>
@endsection

@section('active')
    <table class="active-table table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('app.category')}}</th>
            <th>{{trans('app.position')}}</th>
            <th>{{trans('app.experience')}}</th>
            <th>{{trans('app.vacancy')}}</th>
            <th>{{trans('app.expire_date')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.details')}}</th>
            <th>{{trans('app.requirements')}}</th>
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
            <th>{{trans('app.position')}}</th>
            <th>{{trans('app.experience')}}</th>
            <th>{{trans('app.vacancy')}}</th>
            <th>{{trans('app.expire_date')}}</th>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.details')}}</th>
            <th>{{trans('app.requirements')}}</th>
            <th>{{trans('app.action')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('tableTabScript')

    @include('recruitment::scripts.jobs')

@endsection
