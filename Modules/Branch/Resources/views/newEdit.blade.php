@extends('layouts.modal', ['size' => 'lg'])

@section('modal')

    <div class="form-body">
        <div class="row">
            @if(is_admin_group())
                {{--user Role--}}
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="company">
                        {{trans('app.company')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control select2-dropdown w-100"  name="com_id" id="company">
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(get_companies() as $key => $value)
                                <option value="{{ $key }}"
                                        @if(!empty($branch->com_id))@if($key == $branch->com_id) selected @endif @endif >
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="name" name="name" required
                           value="@if($branch){{$branch->name}}@endif" placeholder="{{trans('app.name')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="phone">
                    {{trans('app.phone')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="phone" type="text" name="phone" required
                           value="@if($branch){{$branch->phone}}@endif" placeholder="{{trans('app.phone')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="email">
                    {{trans('app.email')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="email" class="form-control" type="email" name="email" required
                           value="@if($branch){{ $branch->email }}@endif" placeholder="{{trans('app.email')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="address">
                    {{trans('app.address')}}
                </label>
                <div class="item form-group">
                    <input id="email" class="form-control" type="text" name="address"
                           value="@if($branch){{ $branch->address }}@endif" placeholder="{{trans('app.address')}}">
                </div>
            </div>

            {{--user Role--}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="role">
                    {{trans('app.role')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-dropdown w-100" name="role_id" id="role">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(get_roles(\App\Models\Role::ROLE_BRANCH) as $key => $value)
                            <option value="{{ $key }}"
                                    @if(!empty($branch->user->role_id))@if($key == $branch->user->role_id) selected @endif @endif > {{ $value }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                                @if($branch) @if($branch->user->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                @if($branch) @if($branch->user->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>


            @if(! $branch)

                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="password">
                        {{trans('app.password')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <input id="password" class="form-control" type="password" name="password" required
                               placeholder="{{trans('app.password')}}">

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
                               name="password_confirmation" required
                               placeholder="{{trans('app.password_confirmation')}}">
                        <span id="alert_confirm" class="help-block help-block-custom text-danger"></span>
                    </div>
                </div>

            @endif

        </div>
    </div>

@endsection


