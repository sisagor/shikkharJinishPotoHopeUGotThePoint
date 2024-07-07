@extends('layouts.modal', ['size' => 'md'])
@php
//dd(get_employee_leaveTypes())
@endphp

@section('modal')

    <div class="form-body">
        <div class="row">

            @if(! is_employee_user())
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="employee_id">
                        {{trans('app.employee')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control select2-ajax" data-link="{{route('employee.getEmployee')}}" autofocus id="employee_id"
                                name="employee_id" required>
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="leave_for">
                    {{trans('app.leave_for')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="leave_for" name="leave_for" required>
                        <option value="">{{trans('app.select')}}</option>
                        <option value="{{config('timesheet.type_days.value')}}">{{config('timesheet.type_days.name')}}</option>
                        <option value="{{config('timesheet.type_hour.value')}}">{{config('timesheet.type_hour.name')}}</option>
                    </select>
                </div>
            </div>


            <div class="col-md-6 col-sm-6  daysDate">
                <label class="col-form-label label-align" for="leave_type">
                    {{trans('app.leave_type')}}
                </label>
                <div class="item form-group">
                    <select class="form-control" name="type_id" id="leave_type">
                        <option value="">{{ trans('app.select') }}</option>
                        @if(is_employee())
                            @foreach(json_decode(get_employee_leaveTypes()) as $type)
                                <option value="{{ $type->id }}"> {{ $type->name }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 daysDate hide">
                <label class="col-form-label label-align" for="start_date">
                    {{trans('app.start_date')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" type="text" id="start_date" name="start_date"/>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 daysDate hide">
                <label class="col-form-label label-align" for="end_date">
                    {{trans('app.end_date')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" type="text" id="end_date" name="end_date"/>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 hourDate hide">
                <label class="col-form-label label-align" for="date">
                    {{trans('app.leave_date')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" type="text" id="date" name="leave_hour_date"/>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 hourDate hide">
                <label class="col-form-label label-align" for="leave_hour">
                    {{trans('app.leave_hour')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" placeholder="1.0" id="leave_hour" name="leave_hour"/>
                </div>
            </div>


            @if(has_permission('leaveApprove') && has_permission('leaveReject') && ! is_employee())
                {{-- Approval Status--}}
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="approval_status">
                        {{trans('app.approval_status')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" name="approval_status" id="approval_status">
                            <option value="{{\Modules\Timesheet\Entities\LeaveApplication::APPROVAL_STATUS_PENDING}}">
                                {{trans('app.pending')}} </option>
                            <option value="{{\Modules\Timesheet\Entities\LeaveApplication::APPROVAL_STATUS_APPROVED}}">
                                {{trans('app.approve')}} </option>
                            {{--<option value="{{\Modules\Timesheet\Entities\LeaveApplication::APPROVAL_STATUS_REJECTED}}">
                                  {{trans('app.inactive')}} </option>--}}
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="attachment">
                    {{trans('app.attachment')}} (optional)
                </label>
                <div class="item form-group">
                    <input class="custom-file" type="file" placeholder="1.0" id="attachment" name="attachment"/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="details" name="details" required></textarea>
                </div>
            </div>

        </div>
    </div>

@endsection

@include('timesheet::scripts.leave')


