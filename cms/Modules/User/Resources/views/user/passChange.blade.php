@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12 ml-1">
                <label class="col-form-label label-align" for="password">
                    {{trans('app.current_password')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="current_password" class="form-control" type="password"  name="current_password" required
                           placeholder="{{trans('app.current_password')}}">
                    <span class="password-filed" onclick="hideshow()" >
                        <i id="slash" class="fa fa-eye-slash"></i>
                        <i id="eye" class="fa fa-eye hide"></i>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 ml-1">
                <label class="col-form-label label-align" for="password">
                    {{trans('app.new_password')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="password" class="form-control" type="password"  name="password" required
                           placeholder="{{trans('app.new_password')}}">
                    <span class="password-filed" onclick="hideshow()" >
                        <i id="slash" class="fa fa-eye-slash"></i>
                        <i id="eye" class="fa fa-eye hide"></i>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 ml-1">
                <label class="col-form-label label-align" for="password_confirmation">
                    {{trans('app.password_confirmation')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="password_confirmation" class="form-control mr-3" type="password"  name="password_confirmation" required
                           placeholder="{{trans('app.password_confirmation')}}">
                    <span id="alert_confirm" class="help-block help-block-custom text-danger"></span>
                </div>
            </div>

        </div>
    </div>

@endsection

