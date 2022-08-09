@extends('layouts.app')

@section('contents')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('app.branch_settings')}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        {{--  <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>--}}
                    </ul>
                    <div class="clearfix"></div>
                </div>


                <div class="x_content">
                    {{--Form content--}}
                    <form method="post" enctype="multipart/form-data"
                          action="{{route('branch.branch.settings.update')}}">
                        @csrf
                        <div class="clearfix"></div>

                        <div class="col-md-6 col-sm-6">
                            <fieldset>
                                <legend>{{ trans('app.general_settings') }}
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.general_settings')}}"></i>
                                </legend>

                                <div class="col-md-12 col-sm-12">
                                    <label class="col-form-label label-align" for="attendance_type">
                                        {{trans('app.attendance_system')}} <span class="required">*</span>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                           title="{{ trans('help.attendance_system')}}"></i>
                                    </label>
                                    <div class="item form-group">
                                        <select class="form-control" type="text" id="attendance_type" name="attendance"
                                                required>
                                            <option value="">{{trans('app.select')}}</option>
                                            <option value="ip_based"
                                                    @if(\Modules\Branch\Entities\BranchSetting::ATTENDANCE_IP == config('branch_settings.attendance')) selected @endif />
                                            {{trans('app.ip_based')}}</option>
                                            <option value="manual"
                                                    @if(\Modules\Branch\Entities\BranchSetting::ATTENDANCE_MANUAL == config('branch_settings.attendance')) selected @endif />
                                            {{trans('app.manual')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 @if(\Modules\Branch\Entities\BranchSetting::ATTENDANCE_IP !== config('branch_settings.attendance')) hide @endif device_ip">
                                    <label class="col-form-label label-align" for="device_ip">
                                        {{trans('app.device_ip')}} <span class="required">*</span>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                           title="{{ trans('help.device_ip')}}"></i>
                                    </label>

                                    <div class="item form-group">
                                        <input type="text" class="form-control
                                                @if(\Modules\Branch\Entities\BranchSetting::ATTENDANCE_IP == config('branch_settings.attendance') && config('branch_settings.device_ip')) col-md-8 @else col-md-12 @endif"
                                               id="device_ip" name="device_ip" @if(config('branch_settings.enable_device')) readonly @endif  value="{{config('branch_settings.device_ip')}}"/>

                                        @if(\Modules\Branch\Entities\BranchSetting::ATTENDANCE_IP == config('branch_settings.attendance') && config('branch_settings.device_ip'))
                                            <a href="javascript:void(0)" class="ajax-modal-btn btn btn-warning col-md-4" data-link="{{route('branch.settings.device.test')}}">{{trans('app.test_device')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>


                            @if(\Modules\Branch\Entities\BranchSetting::ATTENDANCE_IP == config('branch_settings.attendance') && config('branch_settings.device_ip'))
                                <div class="col-md-12 col-sm-12">
                                    <div class="">
                                        <ul class="to_do">
                                            <li class="checkbox-todo-custom mt-2">
                                                <div class="col-md-12 col-12 custom-checkbox2">
                                                    <input type="checkbox" value="1" class="flat"
                                                           name="enable_device"
                                                           @if(config('branch_settings.enable_device')) checked @endif /> &nbsp;
                                                    <strong class="font18"> {{trans('app.enable_device')}} </strong>
                                                    <i class="fa fa-question-circle" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="{{ trans('help.enable_device')}}"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>




                        {{--<div class="col-md-6 col-sm-6">
                            <fieldset>
                                <legend>{{ trans('app.employee_settings') }}
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.employee_settings')}}"></i>
                                </legend>

                                <div class="col-md-12 col-sm-12">
                                    <div class="">
                                        <ul class="to_do">

                                            <li class="checkbox-todo-custom mt-2">
                                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                                    <input type="checkbox" value="1" class="flat"
                                                           name="allow_employee_login"
                                                           @if(config('branch_settings.allow_employee_login')) checked @endif/>&nbsp;
                                                    <strong
                                                        style="font-size: large"> {{trans('app.allow_employee_login')}} </strong>
                                                    <i class="fa fa-question-circle" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="{{ trans('help.allow_employee_login')}}"></i>
                                                </div>
                                            </li>

                                           --}}{{-- <li class="checkbox-todo-custom mt-2">
                                                <div class="col-md-1" style="position: relative">
                                                    <input type="checkbox" value="1" class="flat" name="allow_overtime"
                                                           @if(config('branch_settings.allow_overtime')) checked @endif />
                                                </div>
                                                <div class="col-md-11" style="position: relative; margin-top: -4px;">
                                                    <strong
                                                        style="font-size: large"> {{trans('app.allow_overtime')}} </strong>
                                                    <i class="fa fa-question-circle" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="{{ trans('help.allow_overtime')}}"></i>
                                                </div>
                                            </li>--}}{{--

                                        </ul>
                                    </div>
                                </div>
                            </fieldset>
                        </div>--}}

                        <div class="clearfix"></div>
                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-5 mt-2">
                                    <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                                            value="1" class="btn btn-primary"> {{trans('app.update')}}
                                    </button>
                                    <button type="reset" id="resetButton" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{--End Form content--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('branch::scripts.setting')
@endsection

