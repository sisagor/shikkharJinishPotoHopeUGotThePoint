@extends('layouts.app')
@section('contents')

    <div class="row">
        {{--today attendance--}}
        <div class="col-md-6 col-sm-6 col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{trans('app.attendances')}} <small>{{trans('app.today')}}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="todayAttendance" style="height:400px;"></div>
                </div>
            </div>
        </div>

        {{--Leave policy--}}
        <div class="col-md-6 col-sm-6 col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{trans('app.leave_policy')}} <small>company leave policy</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="leavePolicy" class="chart-frame-400"></div>
                </div>
            </div>
        </div>

    </div>



    {{--Attendance Average --}}
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{trans('app.attendances')}} <small>{{trans('app.last_12_month')}}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="attendanceAverage" class="chart-frame-350"></div>
                </div>
            </div>
        </div>
    </div>


    {{--Salary last 12 month--}}
    <div class="row">
    <!-- /top tiles -->
        <div class="col-md-12 col-sm-12 col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{trans('app.salaries')}} <small>{{trans('app.last_12_month')}}</small></h2>
                    {{--<ul class="nav navbar-right panel_toolbox">
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
                    </ul>--}}
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{--<div id="salaryChart" style="height:400px; width: 100% "></div>--}}
                    <div id="salaryChart" class="chart-frame-350"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    @include('scripts.adminDashboard')
@endsection
