<form method="post" enctype="multipart/form-data"
      action="{{route('company.company.settings.update')}}">
    @csrf
    <input type="hidden" name="payroll_settings" value="1">
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
                                       name="has_increment"
                                       @if(config('company_settings.has_increment')) checked @endif /> &nbsp;
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
                                           value="{{config('company_settings.increment_year') ?? 0}}"
                                           name="increment_year" />
                                </div>
                            </div>
                        </li>
                    </ul>


                  {{--  <div class="col-md-12 col-sm-12">
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
                    </div>--}}
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
            <legend>{{ trans('app.efficient_bar_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.efficient_bar_settings')}}"></i>
            </legend>

            <ul class="to_do">
                <li class="checkbox-todo-custom mt-2">
                    <div class="col-md-12 col-12 custom-checkbox2">
                        <input type="checkbox" value="1" class="flat"
                               name="has_efficient_bar" @if(config('company_settings.has_efficient_bar')) checked @endif /> &nbsp;
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
                            <input class="form-control" type="text" id="efficient_bar_year" value="{{config('company_settings.efficient_bar_year') ?? 0}}" name="efficient_bar_year" />
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
