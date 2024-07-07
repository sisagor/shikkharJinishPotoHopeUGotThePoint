@extends('layouts.modal', ['size' => 'md'])

@section('modal')
    <div class="form-body">
        <div class="row">
            <input type="hidden" name="employee_id" value="@if(isset($employeeId)){{$employeeId}}@endif"/>
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="type">
                    {{trans('app.address_type')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.address_type')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="type" name="type" required>
                        <option value="present" @if(!empty($address)) @if ($address->type == "present") selected
                            @endif @endif >{{trans('app.present_address')}}
                        </option>
                        <option value="permanent" @if(!empty($address)) @if ($address->type == "permanent") selected
                            @endif @endif >{{trans('app.permanent_address')}}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="address">
                    {{trans('app.address')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.address')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="address" name="address"
                              required>@if(! empty($address)){{$address->address}}@endif</textarea>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="city">
                    {{trans('app.city')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.city')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="city" name="city" required
                           value="@if(! empty($address)){{$address->city}}@endif"
                           placeholder="{{trans('app.city')}}"/>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="state">
                    {{trans('app.state')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.state')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="state" name="state" required
                           value="@if(! empty($address)){{$address->state}}@endif"
                           placeholder="{{trans('app.state')}}"/>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="country_id">
                    {{trans('app.country')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.country')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-ajax w-100" data-link="{{route('getCountry')}}"
                            id="country_id" name="country_id" required>
                        @if(! empty($address))
                            <option value="{{$address->country_id}}" selected>
                                {{ $address->country->name }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection


