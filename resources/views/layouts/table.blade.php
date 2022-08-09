@extends('layouts.app')

@section('styles')
    <link href="{{mix('css/datatable.css')}}" rel="stylesheet">
@endsection


@section('contents')
    {{--
     you have to pass this 2 parramitter when you call this layout
     Table Title $title
     action button type $btnType
     Table contents
     --}}
    <div class="row">
        {{--Filter section--}}
        @if(! empty($filter))
            <div class="filter-box mb-2">
                <div class="col-md-1">
                    <strong class="font25">{{trans('app.filter')}}</strong>
                </div>
                <div class="col-md-11 col-sm-11 col-12">

                    @if(is_admin_group())
                        <div class="col-md-5 col-sm-5 col-12">
                            <div class="col-md-6 col-sm-2 col-12">
                                <select class="form-control" name="company" id="company-filter">
                                    <option value="">{{trans('app.select_company')}}</option>
                                    @foreach(get_companies() as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-2 col-12">
                                <select class="form-control" name="branch" id="branch-filter">
                                    <option value="">{{trans('app.select_branch')}}</option>
                                    @foreach(get_branches() as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if(is_company_group() || is_department_admin())
                        <div class="col-md-3 col-sm-3 col-12">
                            {{-- <label class="col-md-5 col-form-label label-align" for="employee_index">
                                 {{trans('app.branch')}}
                                 <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                                    title="{{ trans('help.select_branch')}}"></i>
                             </label>--}}
                            <select class="form-control" name="branch" id="branch-filter">
                                <option value="">{{trans('app.select_branch')}}</option>
                                @foreach(get_branches() as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @yield('filter')

                </div>
            </div>
        @endif
        {{--End Filter Section--}}


        {{-- Table section--}}
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('app.module.'.session('module')) }}
                        <small> {{ (! empty($title) ? trans('app.'.$title) : ' ' )}} </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <div class="clearfix"></div>
                        <li class="dropdown">
                            {!! add_button($btnType ?? null) !!}
                        </li>
                        @if(! empty($customBtn))
                            <li class="dropdown mr-10">
                               @yield('customBtn')
                            </li>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        {{-- <div class="col-sm-12">--}}
                        <div class="card-box table-responsive">
                            {{--<div class="container-fluid dt-bootstrap no-footer">--}}
                            @yield('table')
                            {{-- </div>--}}
                        </div>
                        {{-- </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Table section--}}

@endsection

@section('scripts')
    <!-- Datatables -->
    <script src="{{mix('js/datatable.js')}}"></script>
    @yield('tableScript')

    @include('scripts.datatable')
@endsection


