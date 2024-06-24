@extends('layouts.app')

@section('styles')
    <link href="{{mix('css/calendar.css')}}" rel="stylesheet">
@endsection

@section('contents')

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-8 col-sm-8 col-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{trans('app.holidays')}} <small>Calendar</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            @if(has_permission_url('timesheet/attendance/add'))
                                <a href="javascript:void(0)" data-link="{{route('timesheet.attendance.add')}}" class="btn btn-success ajax-modal-btn"><span class="text-white">{{trans('app.new_punch')}}</span></a>
                            @endif
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div id='calendar'></div>

                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-4 col-12">
                {{--//Chart--}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ trans('app.month_summery') }}</h2>
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

@section('scripts')
    <script src="{{mix('js/calendar.js')}}"></script>
    @include('scripts.employeeDashboard')
@endsection
