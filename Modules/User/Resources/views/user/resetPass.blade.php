
@extends('layouts.form', ['title' => 'edit_role'])

@section('form')

    <div class="form-body mt-2">
        <div class="row">
            <div class="col-md-4 col-sm-4"></div>
            <div class="col-md-4 col-sm-4">

            <div class="col-md-12 col-sm-12 ml-1">
                <label class="col-form-label label-align" for="password">
                    {{trans('app.search_user')}} <span class="required">*</span>
                </label>
                <div class="item form-group">

                    <select class="form-control select2-ajax" data-text="{{trans('help.search_user')}}"
                            data-link="{{route('userManagements.user.getUser')}}" name="user_id" id="user-filter">
                        <option value="">{{trans('app.select_user')}}</option>
                    </select>

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
                        <i id="eye" class="fa fa-eye hide" ></i>
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
        <!-- /Row -->
        </div>
    </div>

@endsection

@section('formScripts')
    <script>
        function hideshow() {
            var password = document.getElementById("password");
            var slash = document.getElementById("slash");
            var eye = document.getElementById("eye");

            if (password.type === 'password')
            {
                password.type = "text";
                slash.style.display = "block";
                eye.style.display = "none";
            }
            else
            {
                password.type = "password";
                slash.style.display = "none";
                eye.style.display = "block";

            }
        }
    </script>
@endsection



