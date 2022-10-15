
<form method="post" enctype="multipart/form-data"
      action="{{route('company.company.settings.update')}}">
    @csrf
    <div class="clearfix"></div>

    <div class="col-md-6 col-sm-6">
        <fieldset>
            <legend>{{ trans('app.provident_fund') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.provident_fund')}}"></i>
            </legend>

            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">
                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="has_provident_fund"
                                       @if(config('company_settings.has_provident_fund')) checked @endif /> &nbsp;
                                <strong class="font18"> {{trans('app.has_provident_fund')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.has_provident_fund')}}"></i>
                            </div>
                        </li>
                    </ul>

                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label label-align" for="employee_pf">
                            {{trans('app.employee_pf')}} (in percent)
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                               title="{{ trans('help.employee_pf')}}"></i>
                        </label>
                        <div class="item form-group">
                            <input class="form-control" type="text" maxlength="2" id="employee_pf"
                                   value="{{config('company_settings.employee_pf') ?? 0}}"
                                   name="employee_pf" />
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label label-align" for="company_pf">
                            {{trans('app.company_pf')}} (in percent)
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                               title="{{ trans('help.company_pf')}}"></i>
                        </label>
                        <div class="item form-group">
                            <input class="form-control" type="text" maxlength="2" id="company_pf"
                                   value="{{config('company_settings.company_pf') ?? 0}}"
                                   name="company_pf"/>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>


   {{-- <li class="checkbox-todo-custom mt-2">
        <div class="col-md-12 col-12 custom-checkbox2">
            <input type="checkbox" value="1" class="flat"
                   name="has_allowances"
                   @if(config('company_settings.has_allowances')) checked @endif /> &nbsp;
            <strong class="font18"> {{trans('app.has_allowances')}} </strong>
            <i class="fa fa-question-circle" data-toggle="tooltip"
               data-placement="top"
               title="{{ trans('help.has_allowances')}}"></i>
        </div>
    </li>--}}



    <div class="col-md-6 col-sm-6">
        <fieldset>
            <legend>{{ trans('app.welfare') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.welfare')}}"></i>
            </legend>

            <ul class="to_do">
                <li class="checkbox-todo-custom mt-2">
                    <div class="col-md-12 col-12 custom-checkbox2">
                        <input type="checkbox" value="1" class="flat"
                               name="has_welfare_fund" @if(config('company_settings.has_welfare')) checked @endif /> &nbsp;
                        <strong class="font18"> {{trans('app.has_welfare_fund')}} </strong>
                        <i class="fa fa-question-circle" data-toggle="tooltip"
                           data-placement="top"
                           title="{{ trans('help.has_welfare_fund')}}"></i>
                    </div>
                </li>
            </ul>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="welfare_fund_amount">
                    {{trans('app.welfare_fund_amount')}} (in percent)
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                       title="{{ trans('help.welfare_fund_amount')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="default_password" value="{{config('company_settings.welfare_fund_amount') ?? 0}}" name="welfare_fund_amount" />
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

                        <li class="checkbox-todo-custom mt-2">
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

                        <li class="checkbox-todo-custom mt-2">
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
{{--End Form content--}}
