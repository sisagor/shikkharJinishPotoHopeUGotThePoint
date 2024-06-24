@extends('layouts.app')

@section('styles')
    <link href="{{mix('css/datatable.css')}}" rel="stylesheet" type="text/css">
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
                        <div class="col-md-3 col-sm-3 col-12">
                            <select class="form-control" name="company" id="company-filter">
                                <option value="">{{trans('app.select_branch')}}</option>
                                @foreach(get_companies() as $id => $name)
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
                        <small> {{ (! empty($title1) ? trans('app.'.$title1) : ' ' )}} </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <div class="clearfix"></div>

                        @yield('buttons1')

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        {{-- <div class="col-sm-12">--}}
                        <div class="card-box table-responsive">
                            {{--<div class="container-fluid dt-bootstrap no-footer">--}}
                            @yield('table1')
                            {{-- </div>--}}
                        </div>
                        {{-- </div>--}}
                    </div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('app.module.'.session('module')) }}
                        <small> {{ (! empty($title2) ? trans('app.'.$title2) : ' ' )}} </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <div class="clearfix"></div>

                        @yield('buttons2')

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        {{-- <div class="col-sm-12">--}}
                        <div class="card-box table-responsive">
                            {{--<div class="container-fluid dt-bootstrap no-footer">--}}
                            @yield('table2')
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
    @yield('dualTableScript')

    @include('scripts.datatable')
@endsection


