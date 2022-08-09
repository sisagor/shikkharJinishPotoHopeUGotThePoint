@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.employment_type_name')}}">
                    </i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="name" name="name" value="@if(!empty($type)){{$type->name}}@endif"
                           placeholder="{{trans('app.name')}}" required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="allow_company_facility">
                    {{trans('app.allow_company_facility')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.allow_company_facility')}}">
                    </i>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="allow_company_facility" name="allow_company_facility" required>
                        <option value="">{{trans('app.select')}}</option>
                        <option value="{{\Modules\Settings\Entities\EmployeeType::COMPANY_FACILITY_ALLOW}}">{{trans('app.yes')}}</option>
                        <option value="{{\Modules\Settings\Entities\EmployeeType::COMPANY_FACILITY_NOT_ALLOW}}">{{trans('app.no')}}</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="details" name="details" required>@if($type) {{$type->details}} @endif</textarea>
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
                                @if($type) @if($type->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                @if($type) @if($type->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>


        </div>
    </div>

@endsection


