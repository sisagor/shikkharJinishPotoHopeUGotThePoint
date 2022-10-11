@extends('layouts.form')

{{--button use this--}}
@section('buttons')
    {!! list_button('employee.employees', 'employees') !!}
@endsection

@section('form')
    <div class="form-body">
        <div class="row">
            {{--Employemnt Info--}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="employee_index">
                    {{trans('app.employee_id')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.employee_id')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="employee_index" name="employee_index"
                           value="{{$empId}}" required>
                </div>
            </div>
            {{--End Employemnt Info--}}

            {{--Personal Info--}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="name" name="name" required
                           placeholder="{{trans('app.name')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="email">
                    {{trans('app.email')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.email')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="email" autocomplete="off" id="email" name="email" required
                           placeholder="{{trans('app.email')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="phone">
                    {{trans('app.phone')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.phone')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="phone" name="phone" required value="{{config('system_settings.phone_country_code')}}"
                           placeholder="{{trans('app.phone')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="joining_date">
                    {{trans('app.joining_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.joining_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input type="text" class="form-control datePicker" id="joining_date" name="joining_date" required
                          autocomplete="off" placeholder="{{trans('app.joining_date')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="card_no">
                    {{trans('app.card_no')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.card_no')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" maxlength="10" id="card_no" name="card_no"
                           placeholder="{{trans('app.card_no')}}">
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.status')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}">
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}">
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

            {{--End Personal Info--}}

            @if(config('company_settings.allow_employee_login') && empty($employee))
                <div class="col-md-12 custom-bar mt-3 mb-2">
                    <strong class="font25">{{trans('app.create_user')}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="checkbox mt-1" name="create_user" value="1" type="checkbox" id="createUser">
                </div>
                {{--Access Role--}}
                <div class="col-md-12 hide" id="createUserInfo">
                    <div class="col-md-6 col-sm-6">
                        <label class="col-form-label label-align" for="role_id">
                            {{trans('app.access_role')}}
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                               title="{{ trans('help.access_role')}}"></i>
                        </label>
                        <div class="item form-group">
                            <select  class="full-width form-control" id="role_id" name="role_id">
                                <option value="">{{trans('app.select')}}</option>
                                @foreach(get_roles(\App\Models\Role::ROLE_EMPLOYEE) as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--access Level--}}
                    {{--  <div class="col-md-6 col-sm-6">
                          <label class="col-form-label label-align" for="level">
                              {{trans('app.access_level')}} <span class="required">*</span>
                              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                                 title="{{ trans('help.access_level')}}"></i>
                          </label>
                          <div class="item form-group">
                              <select class="form-control" name="level" id="level">
                                  @foreach(config('user.user_levels') as $level)
                                      <option value="{{$level['value']}}">
                                          {{ $level['name'] }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>
                      </div>--}}

                    <div class="col-md-6 col-sm-6">
                        <label class="col-form-label label-align" for="password">
                            {{trans('app.password')}} <span class="required">*</span>
                        </label>
                        <div class="item form-group">
                            <input id="password" class="form-control" type="password" name="password"
                                   placeholder="{{trans('app.password')}}" autocomplete="off">
                            <span class="password-filed" onclick="hideshow()">
                                <i id="slash" class="fa fa-eye-slash"></i>
                                <i id="eye" class="fa fa-eye hide"></i>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label class="col-form-label label-align" for="password_confirmation">
                            {{trans('app.password_confirmation')}} <span class="required">*</span>
                        </label>
                        <div class="item form-group">
                            <input id="password_confirmation" class="form-control" type="password"
                                   name="password_confirmation"
                                   placeholder="{{trans('app.password_confirmation')}}" autocomplete="off">
                            <span id="alert_confirm" class="help-block help-block-custom text-danger"></span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('formScripts')
    @include('employee::scripts.employee')
@endsection

<style>
    .checkbox{
        top: 0!important;
    }
</style>
