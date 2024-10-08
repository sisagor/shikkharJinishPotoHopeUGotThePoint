<style>
    legend {
        margin-bottom: 0rem !important;
    }
</style>

{{--Form content--}}
<form method="post" enctype="multipart/form-data" action="{{ route(session('action'))}}">
    @csrf
    <input type="hidden" name="general" value="general"/>
    <div class="clearfix"></div>
    <div class="col-md-6 col-sm-6">
        <fieldset>
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
                    <label class="col-form-label label-align" for="system_address">
                        {{trans('app.system_address')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.system_address')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="system_address"
                               name="system_address" required
                               value="{{ config('system_settings.system_address') }}">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="system_google_map">
                        {{trans('app.system_google_map')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.system_google_map')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="system_google_map"
                               name="system_google_map" required
                               value="{{ config('system_settings.system_google_map') }}">
                    </div>
                </div>

               {{-- <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="logo">
                        {{trans('app.logo')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.logo')}}"></i>
                    </label>
                    <div class="item form-group">
                        <img class="img-responsive logo_img"
                             src="@if(!empty(config('system_settings.logo')))
                             {{ get_storage_file_url(config('system_settings.logo'), 'small') }}
                             @endif"
                             alt="logo">
                        <input type="file" id="logo" name="logo">
                    </div>
                </div>--}}

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="logo">
                        {{trans('app.login_page_image')}} (536 * 478 px)
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.login_page_image')}}"></i>
                    </label>
                    <div class="item form-group">
                        <img class="img-responsive logo_img"
                             src="@if(!empty(config('system_settings.login_image')))
                             {{ get_storage_file_url(config('system_settings.login_image')) }}
                             @endif"
                             alt="login page image">
                        <input type="file" id="logo" name="login_image">
                    </div>
                </div>

            </div>
        </fieldset>

        <fieldset>
            <legend>{{ trans('app.currency_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.currency_settings')}}"></i>
            </legend>
            <div class="">

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="default_currency">
                        {{trans('app.default_currency')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.default_currency')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control select2-dropdown" type="text" id="default_currency" name="currency_id"
                                required>
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(currencies() as $key => $val)
                                <option value="{{ $key }}"
                                        @if(config('system_settings.currency_id') == $key) selected @endif>
                                    {{ $val  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <ul class="to_do">
                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                <input type="checkbox" value="1" class="flat"
                                       name="show_currency_symbol"
                                       @if(config('system_settings.show_currency_symbol')) checked @endif> &nbsp; &nbsp;
                                <strong style="font-size: large"> {{trans('app.show_currency_symbol')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('help.show_currency_symbol')}}"></i>
                            </div>
                        </li>
                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                                <input type="checkbox" value="1" class="flat"
                                       name="show_space_after_symbol"
                                       @if(config('system_settings.show_space_after_symbol')) checked @endif> &nbsp; &nbsp;
                                <strong style="font-size: large"> {{trans('app.show_space_after_symbol')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('help.show_space_after_symbol')}}"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </fieldset>
    </div>


    <div class="col-md-6 col-sm-6">


        <fieldset class="mt-2">
            <legend>{{ trans('app.other_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.other_settings')}}"></i>
            </legend>
            <div class="col-md-12 col-sm-12">

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="default_timezone">
                        {{trans('app.default_timezone')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.default_timezone')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control select2-dropdown" type="text" id="default_timezone" name="timezone_id"
                                required>
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(timezones() as $key => $val)
                                <option value="{{ $key }}" @if(config('system_settings.timezone_id') == $key) selected @endif>
                                    {{ $val  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="pagination">
                        {{trans('app.pagination')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.pagination')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="pagination" name="pagination"
                               required
                               value="{{ config('system_settings.pagination') }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="report_pagination">
                        {{trans('app.report_pagination')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.report_pagination')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="report_pagination" name="report_pagination"
                               required
                               value="{{ config('system_settings.report_pagination') }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="system_name">
                        {{trans('app.phone_country_code')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.phone_country_code')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="system_name" name="phone_country_code"
                               required value="{{config('system_settings.phone_country_code')}}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="employee_id_length">
                        {{trans('app.default_password')}} (max 16) <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.default_password')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" maxlength="16" id="default_password"
                               value="{{config('system_settings.default_password')}}"
                               name="default_password"/>
                    </div>
                </div>

            </div>

        </fieldset>


        {{--<fieldset>
            <legend>{{ trans('app.employee_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.employee_settings')}}"></i>
            </legend>
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="employee_id_prefix">
                    {{trans('app.employee_id_prefix')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                       title="{{ trans('help.employee_id_prefix')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" maxlength="3" id="employee_id_prefix"
                           value="{{config('system_settings.employee_id_prefix')}}"
                           name="employee_id_prefix"/>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="employee_id_length">
                    {{trans('app.employee_id_length')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                       title="{{ trans('help.employee_id_length')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="number" maxlength="2" id="employee_id_length"
                           value="{{config('system_settings.employee_id_length')}}"
                           name="employee_id_length"/>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">
                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="allow_employee_login"
                                       @if(config('system_settings.allow_employee_login')) checked @endif/> &nbsp;
                                <strong class="font18"> {{trans('app.allow_employee_login')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.allow_employee_login')}}"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <ul class="to_do">
                    <li class="checkbox-todo-custom mt-2">
                        <div class="col-md-12 col-12 custom-checkbox2">
                            <input type="checkbox" value="1" class="flat"
                                   name="allow_bulk_upload"
                                   @if(config('system_settings.allow_bulk_upload')) checked @endif /> &nbsp;
                            <strong class="font18"> {{trans('app.allow_bulk_upload')}} </strong>
                            <i class="fa fa-question-circle" data-toggle="tooltip"
                               data-placement="top" title="{{ trans('help.allow_bulk_upload')}}"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </fieldset>--}}

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
