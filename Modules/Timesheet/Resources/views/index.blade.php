@extends('layouts.reports', ['title' => 'attendance',  'filter' => 2])

@section('filter')
    <div class="col-md-3 col-sm-3 col-12">
        <select  class="full-width form-control select2-ajax" data-text="{{trans('help.search_employee')}}"
                data-link="{{route('employee.getEmployee')}}" name="employee" id="employee-filter">
            <option value="">{{trans('app.select_employee')}}</option>
        </select>
    </div>

    <div class="col-md-3 col-sm-3 col-12">
        @php
            use Illuminate\Support\Carbon;
            $period = now()->subMonths(12)->monthsUntil(now());
        @endphp
        <select class="form-control" name="month" id="month-filter">
            <option value="">{{trans('app.select_month')}}</option>
            @foreach($period as $date)
                <option value="{{ $date->format('Y-m') }}">{{ $date->format('F-Y') }}</option>
            @endforeach
        </select>
    </div>
@endsection


@section('reports')

    <div class="col-md-12 col-sm-12 col-12">
        <div class="row">

            <div class="col-md-6 col-sm-6 col-12">
                {{--//Chart--}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ trans('app.module.'.session('module')) }}
                            <small> {{ trans('app.month_summery') }} </small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <div class="clearfix"></div>
                            <li class="dropdown">
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="attChart" class="chart-frame-400"></div>
                    </div>
                </div>
              {{--  End Chart--}}
            </div>


            <div class="col-md-6 col-sm-6 col-12">
                {{--//Chart--}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ trans('app.module.'.session('module')) }}
                            <small> {{ trans('app.month_summery') }} </small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <div class="clearfix"></div>
                            <li class="dropdown">
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x-content">
                        <div class="row mt-2">
                            <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-check-square text-success"></i>
                                    </div>
                                    <div class="count"><span id="presentCount">0</span></div>
                                    <h3 class="text-success">{{trans('app.present')}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-close text-danger"></i>
                                    </div>
                                    <div class="count"><span id="absentCount">0</span></div>
                                    <h3 class="text-danger">{{trans('app.absent')}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-bicycle text-warning"></i>
                                    </div>
                                    <div class="count"><span id="leaveCount">0</span></div>
                                    <h3 class="text-warning">{{trans('app.leave')}}</h3>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
              {{--  End Chart--}}
            </div>

        </div>
    </div>

@endsection



@section('reportsScript')
    <script src="{{mix('js/echarts.js')}}"></script>
    @include('timesheet::scripts.dashboard')

   {{-- <script>
        $('.dataTables_filter').addClass('hide');
    </script>--}}
@endsection
