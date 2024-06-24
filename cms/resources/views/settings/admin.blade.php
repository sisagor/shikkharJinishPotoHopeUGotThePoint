@extends('layouts.app')

@section('contents')
    @php
        //dd(currencies());
        //dd(timezones());
    @endphp
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('app.system_settings')}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        {{--  <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>--}}
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item w-15">
                            <a class="nav-link active thin-tab" id="home-tab" data-toggle="tab" href="#generalSettings"
                               role="tab" aria-controls="home"
                               aria-selected="true">{{trans('app.general_settings')}}</a>
                        </li>

                        <li class="nav-item w-15">
                            <a class="nav-link thin-tab" id="home-tab" data-toggle="tab" href="#walletSettings"
                               role="tab" aria-controls="home"
                               aria-selected="true">{{trans('app.wallet_settings')}}</a>
                        </li>

                        <li class="nav-item w-15">
                            <a class="nav-link thin-tab" id="home-tab" data-toggle="tab" href="#payrollSettings"
                               role="tab" aria-controls="home"
                               aria-selected="true">{{trans('app.payroll_settings')}}</a>
                        </li>

                        <li class="nav-item w-15">
                            <a class="nav-link thin-tab" id="home-tab" data-toggle="tab" href="#smsSettings"
                               role="tab" aria-controls="home"
                               aria-selected="true">{{trans('app.sms_settings')}}</a>
                        </li>

                        <li class="nav-item w-15">
                            <a class="nav-link thin-tab" id="home-tab" data-toggle="tab" href="#notificationSettings"
                               role="tab" aria-controls="home"
                               aria-selected="true">{{trans('app.notification_settings')}}</a>
                        </li>
                    </ul >

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="generalSettings" role="tabpanel"
                             aria-labelledby="generalSettings-tab">
                            {{--general settings--}}
                            @include('settings.general')
                        </div>

                        <div class="tab-pane fade" id="smsSettings" role="tabpanel"
                             aria-labelledby="smsSettings-tab">
                            {{--general settings--}}
                            @include('settings.smsSettings')
                        </div>

                        <div class="tab-pane fade" id="notificationSettings" role="tabpanel"
                             aria-labelledby="smsSettings-tab">
                            {{--general settings--}}
                            @include('settings.notification')
                        </div>

                        <div class="tab-pane fade" id="walletSettings" role="tabpanel"
                             aria-labelledby="smsSettings-tab">
                            {{--general settings--}}
                            @include('settings.wallet')
                        </div>

                        <div class="tab-pane fade" id="payrollSettings" role="tabpanel"
                             aria-labelledby="smsSettings-tab">
                            {{--general settings--}}
                            @include('settings.payroll')
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection



