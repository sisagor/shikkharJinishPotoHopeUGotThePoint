@extends('layouts.form', ['title' => 'edit_role'])

{{--button use this--}}
@section('buttons')
    {!! list_button('userManagements.roles', 'roles') !!}
@endsection

@section('form')

    <div class="form-body mt-2">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                        {{trans('app.name')}} <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" id="first-name" name="name" required
                               value="@if(!empty($role)){{$role->name}}@endif"
                               required="required" class="form-control "
                               placeholder="{{trans('app.name')}}">
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="level">
                        {{trans('app.level')}} <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9">
                        <select class="form-control" name="level" id="level">
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(config('user.role_levels') as $level)
                                <option value="{{$level['value']}}" @if(!empty($role)) @if($role->level == $level['value']) selected @endif @endif>
                                    {{ $level['name'] }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align pull-left"
                           for="description"> {{trans('app.details')}}
                    </label>
                    <div class="col-md-9 col-sm-9">
                        <input class="form-control" type="text" required name="details"
                               value="@if(!empty($role)){{$role->details}}@endif"
                               placeholder="{{trans('app.details')}}">
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">
                        {{trans('app.status')}} <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="status" id="status">
                            <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                                    @if(!empty($role)) @if($role->status == get_status($role->status)) selected @endif @endif>
                                {{trans('app.active')}} </option>
                            <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                    @if(!empty($role)) @if($role->status ==  get_status($role->status)) selected @endif @endif>
                                {{trans('app.inactive')}} </option>
                        </select>
                    </div>
                </div>
            </div>

        @include('user::role.modules')
        <!-- /Row -->
        </div>
    </div>

@endsection
