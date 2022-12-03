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
                                    {{trans('app.salary_rule')}} <span class="required">*</span>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.select_salary_rule')}}"></i>
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
                                    {{trans('app.type')}} <span class="required">*</span>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.select_increment_type')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <select class="full-width form-control" type="text" id="type" name="type">
                                        <option value="">{{trans('app.select')}}</option>
                                        <option value="increment">{{ trans('app.increment') }}</option>
                                        <option value="efficient_bar">{{ trans('app.efficient_bar') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="col-form-label label-align" for="increment_year">
                                    {{trans('app.year')}} <span class="required">*</span>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.year')}}"></i>
                                </label>
                                <div class="item form-group">
                                    <select class="full-width form-control" type="text"  name="increment_year" id="increment_year">
                                        <option value="">{{trans('app.select')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="row" id="rule_details">

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



