@extends('layouts.app')
@section('contents')
    @php
        $employee = get_count_employee();
        $leave = get_count_employee_leave();
        $present = get_count_employee_present();

        $active = ($employee - $leave);
        $absent = ($employee - $present);

        $leavePercent = (($leave / 100) * $employee);
        $activePercent = (($employee - $active) > 0 ? (($active / 100 ) * $employee) : 100);

        $presentPercent = (($present / 100 ) * $employee);
        $absentPercent = (($employee - $absent) > 0 ? ((($employee - $absent) / 100) * $employee) : 100);
        // dd(currencies())
        //
    @endphp

    <div class="row d-inline-block">
        <div class="tile_count">

           {{-- <div class="col-lg-2 col-md-3 col-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-bank"></i> {{trans('app.total_branch')}}</span>
                <div class="count green">{{}}</div>
                <a class="count_bottom" href="{{route('branch.branches')}}">{{trans('app.branches')}}</a>
            </div>--}}

            <div class="col-lg-2 col-md-3 col-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> {{trans('app.total_employee')}}</span>
                <div class="count green">{{ $employee }}</div>
                <a class="count_bottom" href="{{route('employee.employees')}}">{{trans('app.employees')}}</a>
            </div>

            <div class="col-lg-2 col-md-3 col-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> {{trans('app.employee_on_leave')}}</span>
                <div class="count"> {{ $leave }}</div>
                <span class="count_bottom">
                     <i class="@if($leavePercent > 10) red @else green @endif"><i class="fa fa-sort-asc"></i>
                         {{ $leavePercent }}%
                     </i>{{trans('app.on_leave')}}
                 </span>
            </div>

            <div class="col-lg-2 col-md-3 col-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> {{trans('app.active_employee')}}</span>
                <div class="count green"> {{ $active }} </div>
                <span class="count_bottom">
                     <i class="@if($activePercent < 90) red @else green @endif"><i class="fa fa-sort-desc"></i>
                         {{ $activePercent }}%
                     </i>{{trans('app.employees')}}
                 </span>
            </div>
            <div class="col-lg-2 col-md-3 col-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> {{trans('app.present_employee')}}</span>
                <div class="count"> {{ $present }}</div>
                <span class="count_bottom"><i class="@if($presentPercent < 90) red @else green @endif">
                         <i class="fa fa-sort-asc"></i>{{$presentPercent}}% </i>
                     {{trans('app.today')}}</span>
            </div>
            <div class="col-lg-2 col-md-3 col-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> {{trans('app.absent_employee')}}</span>
                <div class="count">{{ $absent }}</div>
                <span class="count_bottom">
                     <i class="@if($absentPercent > 10) red @else green @endif">
                         <i class="fa fa-sort-asc"></i>{{$absentPercent}}% </i>
                     {{trans('app.today')}}</span>
            </div>
        </div>
    </div>


    <!-- /top tiles -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{trans('app.salaries')}} <small>{{trans('app.last_12_month')}}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    {{--<div id="salaryChart" style="height:400px; width: 100% "></div>--}}
                    <div id="salaryChart" class="chart-frame-350"></div>

                </div>
            </div>
        </div>

       {{-- <div class="col-md-6 col-sm-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{trans('Attendances')}} <small>{{trans('app.last_12_month')}}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id="attendanceChart" style="height:350px;"></div>

                </div>
            </div>
        </div>--}}


       {{-- <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pie Graph</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id="salaryChart" style="height:350px;"></div>

                </div>
            </div>
        </div>--}}

       {{-- <div class="col-md-6 col-sm-6  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pie Area</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id="echart_pie2" style="height:350px;"></div>

                </div>
            </div>
        </div>--}}

    </div>
    <br/>


@endsection

@section('scripts')
    @include('scripts.adminDashboard')
@endsection
