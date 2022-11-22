@extends('layouts.viewModal', ['size' => 'lg',])

@php($rule = [])

@section('viewModal')

    <div class="form-body">
        <div class="row">
            {{--Salary Rule Basic Info--}}
            <div class="col-md-4 col-sm-4">
                <fieldset>
                    <legend>{{ trans('app.salary_rule_info') }}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_info')}}"></i>
                    </legend>

                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label label-align" for="designation_id">
                            {{trans('app.designation')}}
                            {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status')}}"></i>--}}
                        </label>
                        <div class="item form-group">
                            <select class="full-width form-control" type="text" id="rule_id" name="rule_id">
                                @foreach($rules as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label label-align" for="name">
                            {{trans('app.name')}}
                            {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_name')}}"></i>--}}
                        </label>
                        <div class="item form-group">
                            <input class="form-control" type="text" id="name" name="name" readonly
                                   value="@if($rule) {{$rule->name}} @endif" placeholder="{{trans('app.name')}}">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label label-align" for="basic_salary">
                            {{trans('app.basic_salary')}}
                            {{--<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.basic_salary')}}"></i>--}}
                        </label>
                        <div class="item form-group">
                            <input class="form-control" type="text" id="basic_salary" name="basic_salary" readonly
                                   value="@if($rule) {{ get_formatted_currency($rule->basic_salary) }} @endif">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <label class="col-form-label label-align" for="details">
                            {{trans('app.details')}}
                            {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.rule_details')}}"></i>--}}
                        </label>
                        <div class="item form-group">
                            <textarea class="form-control" type="text" id="details" readonly
                                      name="details"> @if($rule) {{$rule->details}} @endif</textarea>
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
                </fieldset>
            </div>


            <div class="col-md-4 col-sm-4">
                <fieldset>
                    <legend>{{ trans('app.add_with_salary') }}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.salary_structure_add')}}"></i>
                    </legend>
                    @foreach($structures->filter(function ($item){ return $item->type == \Modules\Payroll\Entities\SalaryStructure::TYPE_ADD;}) as $add)
                        <div class="col-md-12 col-sm-12">
                            <label class="col-form-label label-align" for="{{ $add->name }}">
                                {{ $add->salaryStructure->name }} {{ ($add->is_percent) ? '%' : null}}
                            </label>
                            <div class="item form-group">
                                <input class="form-control" type="number" step="*" readonly value="{{(float)$add->amount}}"/>
                            </div>
                        </div>
                    @endforeach
                </fieldset>
            </div>


            <div class="col-md-4 col-sm-4">
                <fieldset>
                    <legend>{{ trans('app.deduct_from_salary') }}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.salary_structure_deduct')}}"></i>
                    </legend>
                    @foreach($structures->filter(function ($item){ return $item->salaryStructure->type == \Modules\Payroll\Entities\SalaryStructure::TYPE_DEDUCT;}) as $deduct)
                        <div class="col-md-12 col-sm-12">
                            <label class="col-form-label label-align" for="{{ $deduct->salaryStructure->name }}">
                                {{ $deduct->salaryStructure->name }} {{ ($deduct->is_percent) ? '%' : null}}
                            </label>
                            <div class="item form-group">
                                <input class="form-control" readonly type="number" step="*" value="{{ (float)$deduct->amount }}"/>
                            </div>
                        </div>
                    @endforeach
                </fieldset>

                {{--  @if(count($structures->filter(function ($item){ return $item->salaryStructure->type == \Modules\Payroll\Entities\SalaryStructure::TYPE_PROVIDENT;})))
                      <fieldset class="mt-3">
                          <legend>{{ trans('app.provident_fund') }}
                              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                                 title="{{ trans('help.salary_structure_deduct')}}"></i>
                          </legend>
                          @foreach($structures->filter(function ($item){ return $item->salaryStructure->type == \Modules\Payroll\Entities\SalaryStructure::TYPE_PROVIDENT;}) as  $provident)
                              <div class="col-md-12 col-sm-12">
                                  <label class="col-form-label label-align" for="{{ $provident }}">
                                      {{ $provident->salaryStructure->name }} {{ ($provident->is_percent) ? '%' : null}}
                                  </label>
                                  <div class="item form-group">
                                      <input class="form-control" readonly type="number" step="*" id="{{ $deduct }}"
                                             value="{{ (float)$provident->amount }}"/>
                                  </div>
                              </div>
                          @endforeach
                      </fieldset>
                  @endif--}}


                {{--  @if(count($structures->filter(function ($item){ return $item->salaryStructure->type == \Modules\Payroll\Entities\SalaryStructure::TYPE_INSURANCE;})))
                      <fieldset class="mt-3">
                          <legend>{{ trans('app.insurance_installation') }}
                              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_structure_deduct')}}"></i>
                          </legend>
                          @foreach($structures->filter(function ($item){ return $item->salaryStructure->type == \Modules\Payroll\Entities\SalaryStructure::TYPE_INSURANCE;}) as $insurance)
                              <div class="col-md-12 col-sm-12">
                                  <label class="col-form-label label-align">
                                      {{ $insurance->salaryStructure->name }} {{ ($insurance->is_percent) ? '%' : null}}
                                  </label>
                                  <div class="item form-group">
                                      <input class="form-control" type="number" step="*" value="{{ (float)$insurance->amount }}" readonly/>
                                  </div>
                              </div>
                          @endforeach
                      </fieldset>
                  @endif--}}
            </div>
        </div>
    </div>

@endsection


@include('payroll::scripts.grade')



