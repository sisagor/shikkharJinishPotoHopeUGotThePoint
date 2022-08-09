@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="department_id">
                    {{trans('app.department')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select  class="form-control select2-dropdown" type="text" id="department_id" name="department_id" required >
                        @foreach(get_departments() as $id => $name)
                            <option value="{{ $id }}" @if(! empty($designation->department_id )) @if($designation->department_id == $id) selected @endif @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input  class="form-control" type="text" id="name" name="name" required
                            value="@if($designation) {{$designation->name}} @endif" placeholder="{{trans('app.name')}}">
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="details" class="form-control" type="text"  name="details"
                           value="@if($designation) {{ $designation->details }} @endif" placeholder="{{trans('app.details')}}">
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
                        @if($designation) @if($designation->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                        @if($designation) @if($designation->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection


