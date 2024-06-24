<form method="post" enctype="multipart/form-data"
      action="{{ route(session('action'))}}">
    @csrf
    <input type="hidden" name="payroll" value="payroll">
    <div class="clearfix"></div>

    <div class="col-md-6 col-sm-6">
        <fieldset>
            <legend>{{ trans('app.increment_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.increment_settings')}}"></i>
            </legend>

            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">
                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="has_efficient_bar" @if(config('system_settings.has_efficient_bar')) checked @endif /> &nbsp;
                                <strong class="font18"> {{trans('app.has_efficient_bar')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.has_efficient_bar')}}"></i>
                            </div>

                            <div class="col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label label-align" for="efficient_bar_year">
                                    {{trans('app.efficient_bar_year')}}
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.efficient_bar_year')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <input class="form-control" maxlength="2" type="text" id="efficient_bar_year" value="{{config('system_settings.efficient_bar_year') ?? 0}}" name="efficient_bar_year" />
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">
                        <li class="checkbox-todo-custom mt-2">
                            <div class="col-md-12 col-12 custom-checkbox2">
                                <input type="checkbox" value="1" class="flat"
                                       name="has_increment"
                                       @if(config('system_settings.has_increment')) checked @endif /> &nbsp;
                                <strong class="font18"> {{trans('app.has_increment')}} </strong>
                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                   data-placement="top"
                                   title="{{ trans('help.has_increment')}}"></i>
                            </div>

                            <div class="col-md-12 col-sm-12 mt-2">
                                <label class="col-form-label label-align" for="increment_year">
                                    {{trans('app.increment_year')}}
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       title="{{ trans('help.increment_year')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <input class="form-control" type="text" maxlength="2" id="increment_year"
                                           value="{{config('system_settings.increment_year') ?? 0}}"
                                           name="increment_year" />
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

        </fieldset>
    </div>

    <div class="col-md-6 col-sm-6">
        <fieldset>
            <legend>{{ trans('app.policy_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.policy_settings')}}"></i>
            </legend>

            <div class="col-md-12 col-sm-12">
                <div class="">
                    <ul class="to_do">

                        <li class="checkbox-todo-custom mt-3">
                            <div class="col-md-12 COL-12 custom-checkbox2" >
                                <input type="checkbox" value="1" class="flat" name="allow_overtime"
                                       @if(config('system_settings.allow_overtime')) checked @endif /> &nbsp;
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
                                       @if(config('system_settings.has_provision_period')) checked @endif /> &nbsp;
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
                                    <input class="form-control" type="text" maxlength="2" id="provision_period" value="{{config('system_settings.provision_period') ?? 0}}"
                                           name="provision_period" placeholder="1" />
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <ul class="to_do">
                    <li class="checkbox-todo-custom mt-3">
                        <div class="col-md-12 col-12" style="position: relative; margin-top: -4px;">
                            <input type="checkbox" value="1" class="flat" name="has_tax_policy"
                                   @if(config('system_settings.has_tax_policy')) checked @endif> &nbsp;&nbsp;
                            <strong style="font-size: large"> {{trans('app.has_tax_policy')}} </strong>
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.has_tax_policy')}}"></i>
                        </div>
                    </li>

                  <li class="checkbox-todo-custom mt-2">
                        <div class="col-md-12 col-12 custom-checkbox2">
                            <input type="checkbox" value="1" class="flat"
                                   name="has_allowances"
                                   @if(config('system_settings.has_allowances')) checked @endif /> &nbsp;
                            <strong class="font18"> {{trans('app.has_allowances')}} </strong>
                            <i class="fa fa-question-circle" data-toggle="tooltip"
                               data-placement="top"
                               title="{{ trans('help.has_allowances')}}"></i>
                        </div>
                    </li>

                    <li class="checkbox-todo-custom mt-2">
                        <div class="col-md-12 col-12 custom-checkbox2">
                            <input type="checkbox" value="1" class="flat"
                                   name="has_attendance_deduction_policy"
                                   @if(config('system_settings.has_attendance_deduction_policy')) checked @endif /> &nbsp;
                            <strong class="font18"> {{trans('app.has_attendance_deduction_policy')}} </strong>
                            <i class="fa fa-question-circle" data-toggle="tooltip"
                               data-placement="top"
                               title="{{ trans('help.has_attendance_deduction_policy')}}"></i>
                        </div>
                    </li>



                </ul>

            </div>

        </fieldset>
    </div>

   {{-- <li class="checkbox-todo-custom mt-2">
        <div class="col-md-12 col-12 custom-checkbox2">
            <input type="checkbox" value="1" class="flat"
                   name="has_allowances"
                   @if(config('system_settings.has_allowances')) checked @endif /> &nbsp;
            <strong class="font18"> {{trans('app.has_allowances')}} </strong>
            <i class="fa fa-question-circle" data-toggle="tooltip"
               data-placement="top"
               title="{{ trans('help.has_allowances')}}"></i>
        </div>
    </li>--}}





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
