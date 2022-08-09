@extends('layouts.app')

@section('contents')

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('app.'.session('actionTitle')) }} </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        {{--  <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>--}}
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" enctype="multipart/form-data" class="validate"
                          action="{{ (!empty(session('actionId')) ? route(session('action'), session('actionId')) : route(session('action')))}}">
                        @csrf
                        <div class="clearfix"></div>

                        {{--Form content--}}
                        <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="{{ get_storage_file_url(optional($profile->profile)->path, 'profile') }}" alt="Avatar" title="Change the avatar">
                                    <input type="file" name="image">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="name">
                                            {{trans('app.name')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <input  class="form-control" type="text" id="name" name="name" required
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
                                            <input id="email" class="form-control" type="email"  name="email" required
                                                   value="@if(!empty($profile)){{$profile->email}}@endif"
                                                   placeholder="{{trans('app.email')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="myDatepicker">
                                            {{trans('app.dob')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <input id="myDatepicker" class="form-control" type="text" name="dob" required
                                                   value="@if(!empty($profile)){{$profile->dob}}@endif"
                                                   placeholder="{{trans('app.dob')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="col-form-label label-align" for="gender">
                                            {{trans('app.gender')}} <span class="required">*</span>
                                        </label>
                                        <div class="item form-group">
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="Male" @if(!empty($profile)) @if($profile->gender == "Male")
                                                selected @endif @endif> {{trans('app.male')}} </option>
                                                <option value="Female" @if(!empty($profile)) @if($profile->gender == "Female")
                                                selected @endif @endif> {{trans('app.female')}} </option>
                                                <option value="Others" @if(!empty($profile)) @if($profile->gender == "Others")
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


                                </div>
                            </div>
                        </div>
                        {{--End Form content--}}

                        <div class="clearfix"></div>
                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-5 mt-2">
                                    <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                                            value="1" class="btn btn-primary">
                                        @if(!empty(session('actionId'))) {{trans('app.update')}} @else {{trans('app.save')}} @endif
                                    </button>
                                    <button type="reset" class="btn btn-success">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

