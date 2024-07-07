@extends('layouts.form')

@section('form')

<div class="form-body">
<div class="row">

{{--Salary Rule Basic Info--}}
<div class="col-md-4 col-sm-4">

    <fieldset>
        <legend>{{ trans('app.salary_rule_info') }}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_info')}}"></i>
        </legend>

      {{--  <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="name">
                {{trans('app.name')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_name')}}"></i>
            </label>
            <div class="item form-group">
                <input  class="form-control" type="text" id="name" name="name" required
                        value="@if($rule){{$rule->name}}@endif" placeholder="{{trans('app.name')}}">
            </div>
        </div>--}}
        <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="grade">
                {{trans('app.grade')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.grade')}}"></i>
            </label>
            <div class="item form-group">
                <input  class="form-control" type="text" id="grade" name="name" required
                        value="@if($rule){{$rule->name}}@endif" placeholder="{{trans('app.grade')}}">
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="designation_id">
                {{trans('app.designation')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status')}}"></i>
            </label>
            <div class="item form-group">
                <select  class="full-width form-control select2-dropdown" type="text" id="designation_id" name="designation_id" required >
                    @foreach(get_designations() as $id => $name)
                        <option value="{{ $id }}" @if(! empty($rule)) @if($rule->designation_id == $id) selected @endif @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
         </div>

        <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="basic_salary">
                {{trans('app.basic_salary')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.basic_salary')}}"></i>
            </label>
            <div class="item form-group">
                <input  class="form-control" type="text" id="basic_salary" name="basic_salary" required
                        value="@if($rule){{round($rule->basic_salary, 2)}}@endif" placeholder="{{trans('placeholder.basic_salary')}}">
            </div>
        </div>

        @if(config('company_settings.has_increment'))
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="increment_amount">
                    {{trans('app.increment_amount')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.increment_amount')}}"></i>
                </label>
                <div class="item form-group">
                    <input  class="form-control" type="text" id="increment_amount" name="increment_amount"
                            value="@if($rule){{round($rule->increment_amount, 2)}}@endif" placeholder="{{trans('placeholder.increment_amount')}}">
                </div>
            </div>
        @endif

        @if(config('company_settings.has_efficient_bar'))
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="efficient_bar_amount">
                    {{trans('app.efficient_bar_amount')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.efficient_bar_amount')}}"></i>
                </label>
                <div class="item form-group">
                    <input  class="form-control" type="text" id="efficient_bar_amount" name="efficient_bar_amount"
                            value="@if($rule){{round($rule->efficient_bar_amount, 2)}}@endif" placeholder="{{trans('placeholder.efficient_bar_amount')}}">
                </div>
            </div>
        @endif

        <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="details">
                {{trans('app.details')}}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.rule_details')}}"></i>
            </label>
            <div class="item form-group">
                <textarea  class="form-control" type="text" required id="details" name="details">@if($rule){{$rule->details}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="status">
                {{trans('app.status')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.status') }}"></i>
            </label>
            <div class="item form-group">
                <select class="form-control" name="status" id="status">
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


    {{--Salary Rule structure components type Add--}}
    @include('payroll::rule.partials.addTypeComponents')



    {{--Salary Rule structure components type Deduct--}}
    @include('payroll::rule.partials.deductTypeComponents')


</div>
</div>

@endsection


