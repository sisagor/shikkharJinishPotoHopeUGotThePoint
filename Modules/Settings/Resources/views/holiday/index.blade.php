@extends('layouts.app', ['title' => 'holidays', 'btnType' => 'modal'])
@php
    use \Illuminate\Support\Carbon;
@endphp
@section('styles')
    <link href="{{mix('css/datatable.css')}}" type="stylesheet" />
@endsection
@section('contents')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('app.module.'.session('module')) }}
                        <small> {{ trans('app.holidays' )}} </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown mr-2">
                            <select class="form-control w-100 float-right" id="holidayYear" name="year">
                                @for($i = 0; $i < 10; $i++)
                                    <option value="{{Carbon::now()->subYear($i)->format('Y')}}"
                                            @if(request()->get('year') == Carbon::now()->subYear($i)->format('Y')) selected
                                            @elseif(date('Y') == Carbon::now()->subYear($i)->format('Y')) selected @endif>
                                        {{ Carbon::now()->subYear($i)->format('Y') }}
                                    </option>
                                @endfor
                            </select></li>
                        <li><a class="collapse-link ml-2 mr-2"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <div class="clearfix"></div>
                        <li class="dropdown ml-2">
                            {!! add_button('modal') !!}
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="card-box table-responsive">
                            <!-- start accordion -->

                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <ul  class="nav nav-tabs d-block" id="holidayTab" role="tablist">

                                        @foreach(get_months_of_the_year(request()->get('year')) as $key => $month)
                                            <li class="nav-item w-15">
                                                <a  class="nav-link @if(date('F') == $month->format('F')) active @endif thin-tab" data-toggle="tab" href="#{{$month->format('FY')}}"
                                                    role="tab" aria-controls="home" id="{{$month->format('Y-m')}}"
                                                    aria-selected="true"><i class="fa fa-calendar"></i> {{trans('app.months.'.strtolower($month->format('F')))}} </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                                <div class="col-md-9 col-sm-9 col-12">
                                    <div class="tab-content" id="holidayTabContent">

                                        @foreach(get_months_of_the_year(request()->get('year')) as $key => $month)

                                            <div class="tab-pane fade @if(date('F') == $month->format('F')) show active @endif" id="{{$month->format('FY')}}" role="tabpanel"
                                                 aria-labelledby="{{$month->format('FY')}}-tab">

                                                <table class="holidays-table-{{$month->format('m')}} table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{trans('app.occasion')}}</th>
                                                        <th>{{trans('app.start_date')}}</th>
                                                        <th>{{trans('app.end_date')}}</th>
                                                        <th>{{trans('app.holiday_days')}}</th>
                                                        <th>{{trans('app.status')}}</th>
                                                        <th>{{trans('app.action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>

                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- end of accordion -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{mix('js/datatable.js')}}"></script>
    <script>
        $('#holidayYear').on('change', function () {
            return window.location = '?year=' + $('#holidayYear').val();
        });
    </script>

    @include('settings::scripts.holidays')
@endsection



