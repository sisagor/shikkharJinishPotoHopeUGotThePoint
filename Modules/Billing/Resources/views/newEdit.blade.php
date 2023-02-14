@extends('layouts.form', ['size' => 'lg'])

@section('form')

    <div class="form-body">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="manager">
                    {{trans('app.manager')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="manager_id" id="manager_id">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($managers as $id => $manager)
                            <option value="{{$id}}" @if($bill)@if($bill->manager_id == $id) selected @endif @endif>
                                {{ $manager }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="project">
                    {{trans('app.project')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="project_id" id="project_id" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}"
                                    @if($bill)@if($bill->project_id == $project->id) selected @endif @endif>
                                {{ $project->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if(! is_employee_user())
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="employee_id">
                        {{trans('app.employee')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control select2-ajax checkProvision" data-link="{{route('employee.getEmployee')}}" autofocus id="employee_id"
                                name="employee_id" required>
                            @if(! empty($bill->employee))
                                <option value="{{$bill->employee->id}}" selected> {{$bill->employee->name}} </option>
                            @endif
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.title')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="title" name="title" required
                           value="@if($bill){{$bill->title}}@endif" placeholder="{{trans('app.title')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="office_id">
                    {{trans('app.office_id')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="office_id" type="text" name="office_id" required
                           value="@if($bill){{$bill->office_id}}@endif" placeholder="{{trans('app.office_id')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="site_id">
                    {{trans('app.site_id')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="site_id" class="form-control" type="text" name="site_id" required
                           value="@if($bill){{ $bill->site_id }}@endif" placeholder="{{trans('app.site_id')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="mobile_bill">
                    {{trans('app.mobile_bill')}}
                </label>
                <div class="item form-group">
                    <input id="mobile_bill" class="form-control" type="text" name="mobile_bill"
                           value="@if($bill){{ $bill->mobile_bill }}@endif" placeholder="{{trans('app.mobile_bill')}}">
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="allowance">
                    {{trans('app.allowance')}}
                </label>
                <div class="item form-group">
                    <input id="allowance" class="form-control" type="text" name="allowance"
                           value="@if($bill){{ $bill->allowance }}@endif" placeholder="{{trans('app.allowance')}}">
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="other_bill">
                    {{trans('app.other_bill')}}
                </label>
                <div class="item form-group">
                    <input id="other_bill" class="form-control" type="text" name="other_bill"
                           value="@if($bill){{ $bill->other_bill }}@endif" placeholder="{{trans('app.other_bill')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="total">
                    {{trans('app.total')}} (click on total) <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="total" class="form-control" type="text" name="total" required
                           value="@if($bill){{ $bill->total }}@endif" placeholder="{{trans('app.total')}}">
                </div>
            </div>

            {{--Status--}}
            @if($bill)
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="status">
                        {{trans('app.status')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" name="status" id="status">
                            <option value="{{\Modules\Billing\Entities\Billing::BILLING_STATUS_PENDING}}"
                                    @if($bill) @if($bill->status ==\Modules\Billing\Entities\Billing::BILLING_STATUS_PENDING) selected @endif @endif>
                                {{trans('app.pending')}} </option>

                            @if(! is_company_admin() || ! is_admin())
                            <option value="{{\Modules\Billing\Entities\Billing::BILLING_STATUS_APPROVE_MANAGER}}"
                                    @if($bill) @if($bill->status == \Modules\Billing\Entities\Billing::BILLING_STATUS_APPROVE_MANAGER) selected @endif @endif>
                                {{trans('app.approve_by_manager')}} </option>
                            @endif

                            @if(is_company_admin() || is_admin())
                                <option value="{{\Modules\Billing\Entities\Billing::BILLING_STATUS_APPROVE_ADMIN}}"
                                        @if($bill) @if($bill->status == \Modules\Billing\Entities\Billing::BILLING_STATUS_APPROVE_ADMIN) selected @endif @endif>
                                    {{trans('app.approve_by_admin')}} </option>
                            @endif

                            <option value="{{\Modules\Billing\Entities\Billing::BILLING_STATUS_REJECTED}}"
                                    @if($bill) @if($bill->status == \Modules\Billing\Entities\Billing::BILLING_STATUS_REJECTED) selected @endif @endif>
                                {{trans('app.reject')}} </option>
                        </select>
                    </div>
                </div>
            @endif

            {{--Status--}}
            @if(! $bill)
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="attachment">
                        {{trans('app.attachment')}}
                    </label>
                    <div class="item form-group">
                        <input id="email" class="form-control" type="file" name="attachment"
                               placeholder="{{trans('app.attachment')}}">
                    </div>
                </div>
            @endif


            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="allowance_history">
                    {{trans('app.allowance_history')}}
                </label>
                <div class="item form-group">
                    <textarea id="email" class="form-control" type="text" name="allowance_history"
                              placeholder="{{trans('app.allowance_history')}}">@if($bill){{ $bill->allowance_history }}@endif</textarea>
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="other_bill_history">
                    {{trans('app.other_bill_history')}}
                </label>
                <div class="item form-group">
                    <textarea id="email" class="form-control" type="text" name="other_bill_history"
                              placeholder="{{trans('app.other_bill_history')}}">@if($bill){{ $bill->other_bill_history }}@endif</textarea>
                </div>
            </div>

            @if($bill)
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="attachment">
                        {{trans('app.attachment')}}
                    </label>
                    <div class="item form-group">
                        <input id="email" class="form-control" type="file" name="attachment" placeholder="{{trans('app.attachment')}}">
                    </div>
                    @if($bill->document)
                        <small><a href="{{get_file_url(optional($bill->document)->path)}}" target="_blank"><strong style="font-size: 20px;">{{$bill->document->name}}</strong></a></small>
                    @endif
                </div>
            @endif


        </div>
    </div>

@endsection
@section('formScripts')
    @include('billing::scripts.script')
@endsection


