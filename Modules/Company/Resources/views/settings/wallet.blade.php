<form method="post" enctype="multipart/form-data"
      action="{{route('company.company.settings.update')}}">
    @csrf
    <input type="hidden" name="wallet_settings" value="1">
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


                            <div class="col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label label-align" for="employee_pf">
                                    {{trans('app.employee_pf')}} (in percent)
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.employee_pf')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <input class="form-control" type="text" maxlength="3" id="employee_pf"
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
                        </li>
                    </ul>

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

                    <div class="col-md-12 col-sm-12 mt-2">
                        <label class="col-form-label label-align" for="welfare_fund_amount">
                            {{trans('app.welfare_fund_amount')}} (in percent)
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                               title="{{ trans('help.welfare_fund_amount')}}"></i>
                        </label>
                        <div class="item form-group">
                            <input class="form-control" type="text" id="default_password" value="{{config('company_settings.welfare_fund_amount') ?? 0}}" name="welfare_fund_amount" />
                        </div>
                    </div>
                </li>
            </ul>

        </fieldset>

        <fieldset class="mt-2">
            <legend>{{ trans('app.gratuity') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.gratuity')}}"></i>
            </legend>

            <ul class="to_do">
                <li class="checkbox-todo-custom mt-2">
                    <div class="col-md-12 col-12 custom-checkbox2">
                        <input type="checkbox" value="1" class="flat"
                               name="has_gratuity" @if(config('company_settings.has_gratuity')) checked @endif /> &nbsp;
                        <strong class="font18"> {{trans('app.has_gratuity')}} </strong>
                        <i class="fa fa-question-circle" data-toggle="tooltip"
                           data-placement="top"
                           title="{{ trans('help.has_gratuity')}}"></i>
                    </div>

                    <div class="col-md-12 col-sm-12 mt-2">
                        <label class="col-form-label label-align" for="gratuity_apply_after">
                            {{trans('app.gratuity_apply_after')}} (in year)
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                               title="{{ trans('help.gratuity_apply_after')}}"></i>
                        </label>
                        <div class="item form-group">
                            <input class="form-control" maxlength="2" type="text" id="gratuity_apply_after" value="{{config('company_settings.gratuity_apply_after') ?? 0}}"
                                   name="gratuity_apply_after" placeholder="1" />
                        </div>
                    </div>
                </li>
            </ul>

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
