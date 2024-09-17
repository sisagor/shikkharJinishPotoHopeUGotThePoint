@extends('layouts.modal',['size' => 'lg'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="name" name="name" required
                           value="@if(!empty($profile)){{$profile->name}}@endif"
                           placeholder="{{trans('app.name')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="phone">
                    {{trans('app.phone')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="phone" type="text" name="phone" required
                           value="@if(!empty($profile)){{$profile->phone}}@endif"
                           placeholder="{{trans('app.phone')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="email">
                    {{trans('app.email')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="email" class="form-control" type="email" name="email" required
                           value="@if(!empty($profile)){{$profile->email}}@endif"
                           placeholder="{{trans('app.email')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="dob">
                    {{trans('app.dob')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="dob" class="form-control datePicker" name="dob" required
                           value="@if($profile){{$profile->dob}}@endif"
                           placeholder="{{trans('app.dob')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="gender">
                    {{trans('app.gender')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="gender" id="gender">
                        <option value="Male" @if($profile) @if($profile->gender == "Male")
                        selected @endif @endif> {{trans('app.male')}} </option>
                        <option value="Female" @if($profile) @if($profile->gender == "Female")
                        selected @endif @endif> {{trans('app.female')}} </option>
                        <option value="Others" @if($profile) @if($profile->gender == "Others")
                        selected @endif @endif> {{trans('app.others')}} </option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="address">
                    {{trans('app.address')}}
                </label>
                <div class="item form-group">
                    <input id="address" class="form-control" type="text" name="address"
                           value="@if(!empty($profile)){{$profile->address}}@endif"
                           placeholder="{{trans('app.address')}}">
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
                                @if(!empty($profile->user)) @if($profile->user->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                @if(!empty($profile->user)) @if($profile->user->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

            {{--Acceess Role--}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="role_id">
                    {{trans('app.access_role')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="full-width form-control select2-dropdown" name="role_id" id="role_id">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(get_roles(\App\Models\Role::ROLE_ADMIN_USER) as $key => $value)
                            <option value="{{ $key }}" @if(!empty($profile->user))@if($key == $profile->user->role_id) selected @endif @endif > {{ $value }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="about">
                    {{trans('app.about')}}
                </label>
                <div class="item form-group">
                    {{-- <input id="about" class="form-control" type="text" name="about"
                           value="@if(!empty($profile)){{$profile->about}}@endif"
                           placeholder="{{trans('app.about')}}"> --}}
                    <textarea class="form-control" name="about" placeholder="{{ trans('app.about') }}">@if(!empty($profile)){{$profile->about}}@endif</textarea>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="occupation">
                    {{trans('app.occupation')}}
                </label>
                <div class="item form-group">
                    <input id="occupation" class="form-control" type="text" name="occupation"
                           value="@if(!empty($profile)){{$profile->occupation}}@endif"
                           placeholder="{{trans('app.address')}}">
                </div>
            </div>
           
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="facebook">
                    {{trans('app.facebook')}}
                </label>
                <div class="item form-group">
                    <input id="facebook" class="form-control" type="text" name="facebook"
                           value="@if(!empty($profile)){{$profile->facebook}}@endif"
                           placeholder="{{trans('app.facebook')}}">
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="twitter">
                    {{trans('app.twitter')}}
                </label>
                <div class="item form-group">
                    <input id="twitter" class="form-control" type="text" name="twitter"
                           value="@if(!empty($profile)){{$profile->twitter}}@endif"
                           placeholder="{{trans('app.twitter')}}">
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="instagram">
                    {{trans('app.instagram')}}
                </label>
                <div class="item form-group">
                    <input id="instagram" class="form-control" type="text" name="instagram"
                           value="@if(!empty($profile)){{$profile->instagram}}@endif"
                           placeholder="{{trans('app.instagram')}}">
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="linkedin">
                    {{trans('app.linkedin')}}
                </label>
                <div class="item form-group">
                    <input id="linkedin" class="form-control" type="text" name="linkedin"
                           value="@if(!empty($profile)){{$profile->linkedin}}@endif"
                           placeholder="{{trans('app.linkedin')}}">
                </div>
            </div>
        
            @if(empty($profile))

                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="password">
                        {{trans('app.password')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <input id="password" class="form-control" type="password" name="password" required
                               placeholder="{{trans('app.password')}}">

                        <span class="password-filed" onclick="hideshow()">
                        <i id="slash" class="fa fa-eye-slash"></i>
                        <i id="eye" class="fa fa-eye hide" ></i>
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


