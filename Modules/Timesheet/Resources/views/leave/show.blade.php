@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            @if(! is_employee_user())
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="employee_id">
                        {{trans('app.employee')}}
                    </label>
                    <div class="item form-group">
                        <select class="form-control" disabled data-link="{{route('employee.getEmployee')}}" autofocus id="employee_id"
                                name="employee_id" required>
                            <option selected>{{$leave->employee->full_name}}</option>
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="type_id">
                    {{trans('app.leave_type')}}
                </label>
                <div class="item form-group">
                    <select class="form-control" id="type_id" name="type_id" required disabled>
                        <option selected>{{$leave->leaveType->name}}</option>
                    </select>
                </div>
            </div>

            @if($leave->leave_for == config('timesheet.type_days.value'))
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="start_date">
                        {{trans('app.start_date')}}
                    </label>
                    <div class="item form-group">
                        <input class="form-control datePicker"  value="{{$leave->start_date}}" type="text" id="start_date" name="start_date" required/>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="end_date">
                        {{trans('app.end_date')}}
                    </label>
                    <div class="item form-group">
                        <input class="form-control datePicker" value="{{$leave->end_date}}" type="text" id="end_date" name="end_date" required/>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="leave_days">
                        {{trans('app.leave_days')}}
                    </label>
                    <div class="item form-group">
                        <input class="form-control" readonly value="{{$leave->leave_days}}" type="text" name="leave_days" required/>
                    </div>
                </div>
            @endif

            @if($leave->leave_for == config('timesheet.type_hour.value'))
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="leave_date">
                        {{trans('app.leave_date')}}
                    </label>
                    <div class="item form-group">
                        <input class="form-control" readonly value="{{$leave->leave_hour_date}}" type="text" id="leave_date" name="leave_date"/>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="leave_hour">
                        {{trans('app.leave_hour')}}
                    </label>
                    <div class="item form-group">
                        <input class="form-control" readonly value="{{$leave->leave_hour}}" type="text" name="leave_hour"/>
                    </div>
                </div>
            @endif

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}}
                </label>
                <div class="item form-group">
                    <textarea class="form-control" readonly id="details" name="details" required>{{$leave->details}}</textarea>
                </div>
            </div>


            @if(! is_employee_user())
                {{-- Approval Status--}}
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="approval_status">
                        {{trans('app.approval_status')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" name="approval_status" id="approval_status"
                                @if($leave->approval_status ==\App\Models\RootModel::APPROVAL_STATUS_APPROVED) disabled @endif>
                            <option value="{{\App\Models\RootModel::APPROVAL_STATUS_PENDING}}"
                                    @if($leave->approval_status ==\App\Models\RootModel::APPROVAL_STATUS_PENDING) selected @endif>
                                {{trans('app.pending')}} </option>
                            <option value="{{\App\Models\RootModel::APPROVAL_STATUS_APPROVED}}"
                                    @if($leave->approval_status == \App\Models\RootModel::APPROVAL_STATUS_APPROVED) selected @endif>
                                {{trans('app.approve')}} </option>
                            <option value="{{\App\Models\RootModel::APPROVAL_STATUS_REJECTED}}"
                                    @if($leave->approval_status == \App\Models\RootModel::APPROVAL_STATUS_REJECTED) selected @endif>
                                {{trans('app.reject')}} </option>
                        </select>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection



