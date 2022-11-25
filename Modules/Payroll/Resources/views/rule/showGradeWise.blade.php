@extends('layouts.app')
@php
    //dd(config('company_settings'));
@endphp

@section('contents')

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('app.salary_rule')}}
                        <small>{{ trans('app.grade_wise') }}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li></li>
                        {{--  <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>--}}
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-body">

                        <div class="row">

                            <div class="col-md-4 col-sm-4">
                                <label class="col-form-label label-align" for="salary_rule">
                                    {{trans('app.salary_rule')}}
                                    {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status')}}"></i>--}}
                                </label>
                                <div class="item form-group">
                                    <select class="full-width form-control" type="text" id="salary_rule" name="salary_rule">
                                        <option value="">{{trans('app.select')}}</option>
                                        @foreach($rules as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="col-form-label label-align" for="salary_rule">
                                    {{trans('app.type')}}
                                    {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status')}}"></i>--}}
                                </label>
                                <div class="item form-group">
                                    <select class="full-width form-control" type="text" id="type" name="type">
                                        <option value="">{{trans('app.select')}}</option>
                                        <option value="increment">{{ trans('app.increment') }}</option>
                                        <option value="efficient_bar">{{ trans('app.efficient_bar') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4" id="increment_year">
                                <label class="col-form-label label-align" for="year">
                                    {{trans('app.year')}}
                                    {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status')}}"></i>--}}
                                </label>
                                <div class="item form-group">
                                    <select class="full-width form-control" type="text"  name="increment_year">
                                        <option value="">{{trans('app.select')}}</option>
                                        @for($i = 1; $i <= config('company_settings.increment_year'); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 hide" id="efficient_bar_year">
                                <label class="col-form-label label-align" for="year">
                                    {{trans('app.year')}}
                                    {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status')}}"></i>--}}
                                </label>
                                <div class="item form-group">
                                    <select class="full-width form-control" type="text"  name="efficient_bar_year">
                                        <option value="">{{trans('app.select')}}</option>
                                        @for($i = 1; $i <= config('company_settings.efficient_bar_year'); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            {{--Salary Rule Basic Info--}}
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-12 col-sm-12">
                                    <label class="col-form-label label-align" for="name">
                                        {{trans('app.name')}}
                                        {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_name')}}"></i>--}}
                                    </label>
                                    <div class="item form-group">
                                        <input class="form-control" type="text" id="name" name="name" readonly
                                               value="@if($rule) {{$rule->name}} @endif"
                                               placeholder="{{trans('app.name')}}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label class="col-form-label label-align" for="basic_salary">
                                        {{trans('app.basic_salary')}}
                                        {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.basic_salary')}}"></i>--}}
                                    </label>
                                    <div class="item form-group">
                                        <input class="form-control" type="text" id="basic_salary"
                                               name="basic_salary" readonly
                                               value="@if($rule) {{ get_formatted_currency($rule->basic_salary) }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <label class="col-form-label label-align" for="details">{{trans('app.details')}}
                                        {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.rule_details')}}"></i>--}}
                                    </label>
                                    <div class="item form-group">
                                        <textarea class="form-control" type="text" id="details" readonly name="details"> @if($rule){{$rule->details}}@endif</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <label class="col-form-label label-align" for="status">
                                        {{trans('app.status')}}
                                        {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status') }}"></i>--}}
                                    </label>
                                    <div class="item form-group">
                                        <select class="form-control" name="status" id="status" disabled>
                                            <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                                                    @if($rule) @if($rule->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                                                {{trans('app.active')}} </option>
                                            <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                                    @if($rule) @if($rule->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                                                {{trans('app.inactive')}} </option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-4">
                                @foreach($structures->filter(function ($item){ return $item->type == \Modules\Payroll\Entities\SalaryStructure::TYPE_ADD;}) as $add)
                                    <div class="col-md-12 col-sm-12">
                                        <label class="col-form-label label-align" for="{{ $add->name }}">
                                            {{ $add->name }} {{ ($add->is_percent) ? '%' : null}}
                                        </label>
                                        <div class="item form-group">
                                            <input class="form-control" type="number" step="*" readonly
                                                   value="{{(float)$add->amount}}"/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@include('payroll::scripts.grade')
@endsection



