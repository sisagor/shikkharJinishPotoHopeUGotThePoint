{{--Form content--}}
<form method="post" enctype="multipart/form-data" action="{{ route(session('action'))}}">
    @csrf
    <div class="clearfix"></div>
    <inpu type="hidden" name="type" value="general">

    <div class="col-md-6 col-sm-6">
       {{-- <fieldset>
            <legend>{{ trans('app.general_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.general_settings')}}"></i>
            </legend>
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="system_name">
                        {{trans('app.system_name')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.system_name')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="system_name" name="system_name"
                               required
                               value="{{config('system_settings.system_name')}}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="system_phone">
                        {{trans('app.system_phone')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.system_phone')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="system_phone"
                               name="system_phone" required
                               value="{{ config('system_settings.system_phone') }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="system_email">
                        {{trans('app.system_email')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.system_email')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="email" id="system_email"
                               name="system_email" required
                               value="{{ config('system_settings.system_email') }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="logo">
                        {{trans('app.logo')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.logo')}}"></i>
                    </label>
                    <div class="item form-group">
                        <img class="img-responsive logo_img"
                             src="@if(!empty(config('system_settings.logo.path')))
                             {{ get_storage_file_url(config('system_settings.logo.path'), 'small') }}
                             @endif"
                             alt="logo">
                        <input type="file" id="logo" name="logo">
                    </div>
                </div>

            </div>
        </fieldset>--}}

        <fieldset class="mt-2">
            <legend>{{ trans('app.notification_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.notification_settings')}}"></i>
            </legend>
            <input type="hidden" value="1" class="flat" name="notificationSetting">
            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">

                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                <input type="checkbox" value="1" class="flat"
                                       name="system_realtime_notification"
                                       @if(config('system_settings.system_realtime_notification')) checked @endif> &nbsp; &nbsp;
                                <strong
                                    style="font-size: large"> {{trans('app.system_realtime_notification')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('help.system_realtime_notification')}}"></i>
                            </div>
                        </li>

                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                <input type="checkbox" value="1" class="flat"
                                       name="email_notification"
                                       @if(config('system_settings.email_notification')) checked @endif> &nbsp;&nbsp;
                                <strong style="font-size: large"> {{trans('app.email_notification')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('help.email_notification')}}"></i>
                            </div>
                        </li>

                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                <input type="checkbox" value="1" class="flat"
                                       name="sms_notification"
                                       @if(config('system_settings.sms_notification')) checked @endif> &nbsp;&nbsp;
                                <strong style="font-size: large"> {{trans('app.sms_notification')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('help.sms_notification')}}"></i>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </fieldset>
    </div>


    <div class="col-md-6 col-sm-6">

        <fieldset class="mt-2">
            <legend>{{ trans('app.log_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.log_settings')}}"></i>
            </legend>
            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">

                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                <input type="checkbox" value="1" class="flat"
                                       name="store_sms_log"
                                       @if(config('system_settings.store_sms_log')) checked @endif> &nbsp; &nbsp;
                                <strong
                                    style="font-size: large"> {{trans('app.store_sms_log')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('help.store_sms_log')}}"></i>
                            </div>
                        </li>

                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                <input type="checkbox" value="1" class="flat"
                                       name="store_email_log"
                                       @if(config('system_settings.store_email_log')) checked @endif> &nbsp;&nbsp;
                                <strong style="font-size: large"> {{trans('app.store_email_log')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('help.store_email_log')}}"></i>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </fieldset>

    </div>

    <div class="clearfix"></div>
    <div class="ln_solid">
        <div class="form-group">
            <div class="col-md-6 offset-md-5" style="padding: 15px 0px 0px 10px;">
                <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                        value="1" class="btn btn-primary"> {{trans('app.update')}}
                </button>
                <button type="reset" id="resetButton" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </div>
</form>
{{--End Form content--}}
