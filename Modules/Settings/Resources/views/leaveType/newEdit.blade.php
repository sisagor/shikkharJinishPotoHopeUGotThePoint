@extends('layouts.modal', ['size' => 'md'])

@section('modal')
    <div class="form-body">
        <div class="row">

            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="type">
                    {{trans('app.type')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="type" id="type" required>
                        <option value="">{{trans('app.select')}}</option>
                        <option value="{{\Modules\Settings\Entities\LeaveType::PAID_LEAVE}}"
                                @if($leaveType) @if($leaveType->type == \Modules\Settings\Entities\LeaveType::PAID_LEAVE) selected @endif @endif>
                            {{\Modules\Settings\Entities\LeaveType::PAID_LEAVE}} </option>
                        <option value="{{\Modules\Settings\Entities\LeaveType::UNPAID_LEAVE}}"
                                @if($leaveType) @if($leaveType->type == \Modules\Settings\Entities\LeaveType::UNPAID_LEAVE) selected @endif @endif>
                            {{\Modules\Settings\Entities\LeaveType::UNPAID_LEAVE}} </option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="type_name">
                    {{trans('app.type_name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="type_name" name="name" required
                           value="@if(! empty($leaveType)){{$leaveType->name}}@endif"
                           placeholder="{{trans('app.type_name') }}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="days">
                    {{trans('app.leave_days')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="number" step="any" id="days" name="days" required
                           value="@if(! empty($leaveType)){{$leaveType->days}}@endif"
                           placeholder="{{trans('app.leave_days') }}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="details" name="details" required
                              placeholder="{{trans('app.details')}}">@if($leaveType){{$leaveType->details}}@endif</textarea>
                </div>
            </div>


            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                                @if($leaveType) @if($leaveType->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                @if($leaveType) @if($leaveType->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

        </div>
    </div>
@endsection


