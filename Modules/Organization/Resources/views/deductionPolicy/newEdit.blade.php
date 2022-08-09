@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="type">
                    {{trans('app.type')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.deduction_type')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="type" id="type">
                        <option value="{{\Modules\Organization\Entities\DeductionPolicy::TYPE_DAY}}"
                                @if($policy) @if($policy->type == \Modules\Organization\Entities\DeductionPolicy::TYPE_DAY) selected @endif @endif>
                            {{\Modules\Organization\Entities\DeductionPolicy::TYPE_DAY}} </option>
                        <option value="{{\Modules\Organization\Entities\DeductionPolicy::TYPE_HOUR}}"
                                @if($policy) @if($policy->type == \Modules\Organization\Entities\DeductionPolicy::TYPE_HOUR) selected @endif @endif>
                            {{\Modules\Organization\Entities\DeductionPolicy::TYPE_HOUR}} </option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="absent">
                    {{trans('app.absent_day_hour')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.absent_day_hour')}}"></i>
                </label>
                <div class="item form-group">
                    <input  class="form-control" type="number" step="*" id="absent" name="absent" required
                            value="@if($policy){{$policy->absent}}@endif" placeholder="{{trans('app.absent')}}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="col-md-9 mt--10">
                    <label class="col-form-label label-align" for="deduction_amount">
                        {{trans('app.deduction_amount')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.deduction_amount')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input  class="form-control" type="number" step="*" id="deduction_amount" name="deduction_amount" required
                                value="@if($policy){{$policy->deduction_amount}}@endif" placeholder="{{trans('app.deduction_amount')}}">
                    </div>
                </div>
                <div class="col-md-3 mt--10">
                    <label class="col-form-label label-align" for="is_percent">
                        {{ trans('app.is_percent') }}
                    </label>
                    <div class="item form-group ml-3">
                        <input class="checkbox " type="checkbox" @if(! empty($policy))@if($policy->is_percent) checked @endif @endif id="is_percent" name="is_percent" value="1"/>
                    </div>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <textarea id="details" class="form-control" type="text"  name="details">@if($policy){{$policy->details}}@endif</textarea>
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.status')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                        @if($policy) @if($policy->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                        @if($policy) @if($policy->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection


