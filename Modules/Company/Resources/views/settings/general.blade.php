
{{--Form content--}}
<form method="post" enctype="multipart/form-data" action="{{route('company.company.settings.update')}}">
    @csrf
    <div class="clearfix"></div>
    <input type="hidden" name="general_settings" value="1">
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
                                @if(\Modules\Company\Entities\CompanySetting::ATTENDANCE_IP == config('company_settings.attendance')) selected @endif />
                        {{trans('app.ip_based')}}</option>
                        <option value="manual"
                                @if(\Modules\Company\Entities\CompanySetting::ATTENDANCE_MANUAL == config('company_settings.attendance')) selected @endif />
                        {{trans('app.manual')}}</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 @if(\Modules\Company\Entities\CompanySetting::ATTENDANCE_IP !== config('company_settings.attendance')) hide @endif device_ip">
                <label class="col-form-label label-align" for="device_ip">
                    {{trans('app.device_ip')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                       title="{{ trans('help.device_ip')}}"></i>
                </label>
                <div class="item form-group">
                    <input type="text" class="form-control @if(config('company_settings.device_ip')) col-md-8 @else col-md-12 @endif"
                           id="device_ip" name="device_ip" @if(config('company_settings.enable_device')) readonly @endif value="{{config('company_settings.device_ip')}}"/>
                    @if(config('company_settings.device_ip'))
                        <a href="javascript:void(0)" class="ajax-modal-btn btn btn-warning col-md-4" data-link="{{route('company.settings.device.test')}}">{{trans('app.test_device')}}</a>
                    @endif
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">

                        @if(\Modules\Company\Entities\CompanySetting::ATTENDANCE_IP == config('company_settings.attendance')
                            && config('company_settings.device_ip'))

                                <li class="checkbox-todo-custom mt-2">
                                    <div class="col-md-12 col-12 custom-checkbox2">
                                        <input type="checkbox" value="1" class="flat"
                                               name="enable_device"
                                               @if(config('company_settings.enable_device')) checked @endif /> &nbsp;
                                        <strong class="font18"> {{trans('app.enable_device')}} </strong>
                                        <i class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ trans('help.enable_device')}}"></i>
                                    </div>
                                </li>
                        @endif

                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="has_attendance_deduction_policy"
                                       @if(config('company_settings.has_attendance_deduction_policy')) checked @endif /> &nbsp;
                                <strong class="font18"> {{trans('app.has_attendance_deduction_policy')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.has_attendance_deduction_policy')}}"></i>
                            </div>
                        </li>

                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="has_allowances"
                                       @if(config('company_settings.has_allowances')) checked @endif /> &nbsp;
                                <strong class="font18"> {{trans('app.has_allowances')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.has_allowances')}}"></i>
                            </div>
                        </li>

                      {{--  <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="allow_holiday_work_as_overtime"
                                       @if(config('company_settings.allow_holiday_work_as_overtime')) checked @endif /> &nbsp;
                                <strong class="font18"> {{trans('app.allow_holiday_work_as_overtime')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.allow_holiday_work_as_overtime')}}"></i>
                            </div>
                        </li>--}}

                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="allow_bulk_upload"
                                       @if(config('company_settings.allow_bulk_upload')) checked @endif /> &nbsp;
                                <strong class="font18"> {{trans('app.allow_bulk_upload')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top" title="{{ trans('help.allow_bulk_upload')}}"></i>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

        </fieldset>

        <fieldset class="mt-2">
            <legend>{{ trans('app.taxation') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.taxation')}}"></i>
            </legend>
            <div class="col-md-12 col-sm-12">
                <ul class="to_do">
                    <li class="checkbox-todo-custom mt-3">
                        <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                            <input type="checkbox" value="1" class="flat" name="has_tax_policy"
                                   @if(config('company_settings.has_tax_policy')) checked @endif> &nbsp;&nbsp;
                            <strong style="font-size: large"> {{trans('app.has_tax_policy')}} </strong>
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.has_tax_policy')}}"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </fieldset>

    </div>

    <div class="col-md-6 col-sm-6">
        <fieldset>
            <legend>{{ trans('app.employee_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.employee_settings')}}"></i>
            </legend>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="employee_id_length">
                    {{trans('app.default_password')}} (max 16) <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                       title="{{ trans('help.default_password')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" maxlength="2" id="default_password"
                           value="{{config('company_settings.default_password')}}"
                           name="default_password"/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="employee_id_prefix">
                    {{trans('app.employee_id_prefix')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                       title="{{ trans('help.employee_id_prefix')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" maxlength="3" id="employee_id_prefix"
                           value="{{config('company_settings.employee_id_prefix')}}"
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
                           value="{{config('company_settings.employee_id_length')}}"
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
                                       @if(config('company_settings.allow_employee_login')) checked @endif/> &nbsp;
                                <strong class="font18"> {{trans('app.allow_employee_login')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.allow_employee_login')}}"></i>
                            </div>
                        </li>

                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 COL-12 custom-checkbox2" >
                                <input type="checkbox" value="1" class="flat" name="allow_overtime"
                                       @if(config('company_settings.allow_overtime')) checked @endif /> &nbsp;
                                <strong class="font18" > {{trans('app.allow_overtime')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.allow_overtime')}}"></i>
                            </div>
                        </li>

                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="has_provision_period"
                                       @if(config('company_settings.has_provision_period')) checked @endif /> &nbsp;
                                <strong class="font18" > {{trans('app.has_provision_period')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.provision_period')}}"></i>
                            </div>

                            <div class="col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label label-align" for="provision_period">
                                    {{trans('app.provision_period')}} (in month)
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.provision_period')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <input class="form-control" type="text" maxlength="2" id="provision_period" value="{{config('company_settings.provision_period') ?? 0}}"
                                           name="provision_period" placeholder="1" />
                                </div>
                            </div>
                        </li>




                        {{-- <li class="checkbox-todo-custom mt-3">
                             <div class="col-md-1" style="position: relative">
                                 <input type="checkbox" value="1" class="flat"
                                        name="has_provident_fund" id="has_provident_fund"
                                        @if(config('company_settings.has_provident_fund')) checked @endif />
                             </div>
                             <div class="col-md-11" style="position: relative; margin-top: -4px;">
                                 <strong
                                     style="font-size: large"> {{trans('app.has_provident_fund')}} </strong>
                                 <i class="fa fa-question-circle" data-toggle="tooltip"
                                    data-placement="top"
                                    title="{{ trans('help.has_provident_fund')}}"></i>
                             </div>
                         </li>


                         <li class="checkbox-todo-custom mt-3">
                             <div class="col-md-1" style="position: relative">
                                 <input type="checkbox" value="1" class="flat" name="has_insurance" id="has_insurance"
                                        @if(config('company_settings.has_insurance')) checked @endif />
                             </div>
                             <div class="col-md-11" style="position: relative; margin-top: -4px;">
                                 <strong
                                     style="font-size: large"> {{trans('app.has_insurance')}} </strong>
                                 <i class="fa fa-question-circle" data-toggle="tooltip"
                                    data-placement="top"
                                    title="{{ trans('help.has_insurance')}}"></i>
                             </div>
                         </li>--}}

                        {{-- <div class="col-md-12 col-sm-12 providentFund"
                              style="display:@if(config('company_settings.has_provident_fund'))block @else none @endif">
                             <div class="col-md-10">
                                 <label class="col-form-label label-align" for="provident_fund_company_amount">
                                     {{trans('app.provident_fund_company_amount')}} <span class="required">*</span>
                                     <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                        title="{{ trans('help.provident_fund_company_amount')}}"></i>
                                 </label>
                                 <div class="item form-group">
                                     <input class="form-control" type="number" step=".01" id="provident_fund_company_amount"
                                            value="{{config('company_settings.provident_fund_company_amount')}}"
                                            name="provident_fund_company_amount"/>
                                 </div>
                             </div>
                             <div class="col-md-2">
                                 <label class="col-form-label" for="provident_fund_company_amount_percent">
                                     <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                        title="{{ trans('help.is_percent')}}"></i>
                                 </label>
                                 <div class="item form-group">
                                     <input class="checkbox" type="checkbox" id="provident_fund_company_amount_percent"
                                            value="1" name="provident_fund_company_amount_percent"
                                            @if(config('company_settings.provident_fund_company_amount_percent')) checked @endif/>
                                 </div>
                             </div>
                         </div>--}}


                        {{--<div class="col-md-12 col-sm-12 hasInsurance"
                             style="display:@if(config('company_settings.has_insurance'))block @else none @endif">
                            <div class="col-md-10">
                                <label class="col-form-label label-align" for="insurance_company_amount">
                                    {{trans('app.insurance_company_amount')}} <span class="required">*</span>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.insurance_company_amount')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <input class="form-control" type="number" step=".01" id="insurance_company_amount"
                                           value="{{config('company_settings.insurance_company_amount')}}"
                                           name="insurance_company_amount"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label" for="insurance_company_amount_percent">
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.is_percent')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <input class="checkbox" type="checkbox" id="insurance_company_amount_percent"
                                           value="1" name="insurance_company_amount_percent"
                                           @if(config('company_settings.insurance_company_amount_percent')) checked @endif/>
                                </div>
                            </div>
                        </div>--}}

                    </ul>
                </div>
            </div>
        </fieldset>
    </div>

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

