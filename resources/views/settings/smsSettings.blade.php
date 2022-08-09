@php
$tab = 0;
$content = 0;
@endphp

<div class="x_content">
        <fieldset>
            <legend>{{ trans('app.sms_gateway') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.sms_gateway')}}"></i>
            </legend>

            <div class="col-md-12 col-sm-12">
                <div class="col-md-4 col-sm-4 col-12">
                    <ul  class="nav nav-tabs" id="smsTab" style="display: block!important;" role="tablist">
                        @foreach(config('sms.drivers') as $key => $driver)
                            <li class="nav-item w-15">
                                <a  class="nav-link @if(config('sms_gateway.driver') == $key) active @endif thin-tab" data-toggle="tab" href="#{{$key}}"
                                   role="tab" aria-controls="home"
                                   aria-selected="true"><i class="fa fa-gear"></i> {{trans('app.sms_gateways.'.$key)}} </a>
                            </li>
                            @php
                                $tab = $tab + 1;
                            @endphp
                        @endforeach

                    </ul>
                </div>

                <div class="col-md-8 col-sm-8 col-12">
                    <div class="tab-content" id="smsTabContent">

                        @foreach(config('sms.drivers') as $key => $driver)
                            @php
                                $item = get_single_sms_gateway($key);
                                $active =($item ? json_decode($item->details, true) : []);
                                $status = ($item ? $item->status : null);
                            @endphp

                            <div class="tab-pane fade @if(config('sms_gateway.driver') == $key) show active @endif" id="{{$key}}" role="tabpanel"
                                 aria-labelledby="{{$key}}-tab">

                                <form method="post" enctype="multipart/form-data" action="{{ route('settings.smsGateway')}}">
                                    @csrf
                                    <input class="form-control" type="hidden"  name="driver" value="{{$key}}">
                                    <div class="box" style="height: fit-content; background: #e6e9ed; border: #0eaa6f 1px solid">

                                        <div class="col-md-12 col-sm-12 col-12">
                                            <span><strong>{{trans('app.get_help')}}</strong> &nbsp;&nbsp;
                                                <a target="_blank" class="text text-info" href="{{$driver['site_url']}}"> {{$driver['site_url']}} </a></span>
                                        </div>

                                        @foreach(array_keys($driver) as $item)

                                            @if($item !== 'site_url')
                                                <div class="col-md-12 col-sm-12 col-12">
                                                    <label class="col-form-label label-align" for="{{$key.'_'.$item}}">
                                                        {{trans('app.'.$item)}} <span class="required">*</span>
                                                    </label>
                                                    <div class="item form-group">
                                                        <input class="form-control" type="text" id="{{$key.'_'.$item}}" name="{{$key.'['.$item.']'}}"
                                                               value="@if(!empty($active[$item])) {{$active[$item]}} @endif">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                        <div class="col-md-12 col-sm-12 col-12">
                                            <label class="col-form-label label-align" for="status">
                                                {{trans('app.status')}} <span class="required">*</span> <span>only one gateway can be active at a time</span>
                                            </label>
                                            <div class="item form-group">
                                                <select class="form-control" type="text" id="status" name="status">
                                                    <option value="">{{trans('app.select')}}</option>
                                                    <option value="1" @if($status == 1) selected @endif>
                                                        {{trans('app.active')}}</option>
                                                    <option value="0" @if($status == 0) selected @endif>
                                                        {{trans('app.inactive')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="ln_solid">
                                        <div class="form-group">
                                            <div class="col-md-6 offset-md-5 col-sm-6 col-sm-offset-5" style="padding: 15px 0px 0px 10px;">
                                                <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                                                        value="1" class="btn btn-primary"> {{trans('app.update')}}
                                                </button>
                                                <button type="reset" id="resetButton" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </div>

                                    </form>
                                </div>

                            @php
                                $content = $content + 1;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>

            {{--<div class="col-md-4 col-sm-4 col-12">
                <fieldset>
                    <legend>{{ trans('app.when_trigger') }}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.when_trigger')}}"></i>
                    </legend>

                    <form method="post" enctype="multipart/form-data" action="{{ route('settings.smsGateway')}}">
                        @csrf

                    <div class="col-md-12 col-sm-12 col-12">
                        <ul class="to_do">
                            @php
                              $event = json_decode(config('system_settings.sms_events'), true);
                            @endphp
                            <li class="checkbox-todo-custom mt-3">
                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                    <input  type="checkbox" value="1" class="flat" name="event[create_employee]"
                                            @if(isset($event['create_employee'])) checked @endif> &nbsp;&nbsp;
                                    <strong style="font-size: large"> {{trans('app.create_employee')}} </strong>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.create_employee')}}"></i>
                                </div>
                            </li>

                            <li class="checkbox-todo-custom mt-3">
                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                    <input  type="checkbox" value="1" class="flat " name="event[update_employee_info]"
                                            @if(isset($event['update_employee_info'])) checked @endif> &nbsp;&nbsp;
                                    <strong style="font-size: large"> {{trans('app.update_employee_info')}} </strong>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.update_employee_info')}}"></i>
                                </div>
                            </li>

                            <li class="checkbox-todo-custom mt-3">
                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                    <input  type="checkbox" value="1" class="flat " name="event[late_attendance]"
                                            @if(isset($event['late_attendance'])) checked @endif> &nbsp;&nbsp;
                                    <strong style="font-size: large"> {{trans('app.late_attendance')}} </strong>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.late_attendance')}}"></i>
                                </div>
                            </li>

                            <li class="checkbox-todo-custom mt-3">
                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                    <input  type="checkbox" value="1" class="flat " name="event[leave_application_approve]"
                                            @if(isset($event['leave_application_approve'])) checked @endif> &nbsp;&nbsp;
                                    <strong style="font-size: large"> {{trans('app.leave_application_approve')}} </strong>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.leave_application_approve')}}"></i>
                                </div>
                            </li>

                            <li class="checkbox-todo-custom mt-3">
                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                    <input  type="checkbox" value="1" class="flat " name="event[leave_application_reject]"
                                            @if(isset($event['leave_application_reject'])) checked @endif> &nbsp;&nbsp;
                                    <strong style="font-size: large"> {{trans('app.leave_application_reject')}} </strong>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.leave_application_reject')}}"></i>
                                </div>
                            </li>

                            <li class="checkbox-todo-custom mt-3">
                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                    <input  type="checkbox" value="1" class="flat " name="event[salary_approve]"
                                            @if(isset($event['salary_approve'])) checked @endif> &nbsp;&nbsp;
                                    <strong style="font-size: large"> {{trans('app.salary_approve')}} </strong>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.salary_approve')}}"></i>
                                </div>
                            </li>

                            <li class="checkbox-todo-custom mt-3">
                                <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                    <input  type="checkbox" value="1" class="flat " name="event[salary_payment]"
                                            @if(isset($event['salary_payment'])) checked @endif> &nbsp;&nbsp;
                                    <strong style="font-size: large"> {{trans('app.salary_payment')}} </strong>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.salary_payment')}}"></i>
                                </div>
                            </li>

                        </ul>
                    </div>

                        <div class="clearfix"></div>
                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-5 col-sm-6 col-sm-offset-5" style="padding: 15px 0px 0px 10px;">
                                    <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                                            value="1" class="btn btn-primary"> {{trans('app.update')}}
                                    </button>
                                    <button type="reset" id="resetButton" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </fieldset>
            </div>--}}

        </fieldset>

</div>
