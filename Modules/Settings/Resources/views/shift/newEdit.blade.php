@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="name" name="name" value="@if(!empty($shift)){{$shift->name}}@endif"
                           placeholder="{{trans('app.name')}}" required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="start_time">
                    {{trans('app.start_time')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control timePicker" type="text" id="start_time" name="start_time" required
                           value="@if($shift){{$shift->start_time}}@endif">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="end_time">
                    {{trans('app.end_time')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control timePicker" type="text" id="end_time" name="end_time" required
                           value="@if($shift){{$shift->end_time}}@endif"/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="details" name="details"
                              required>@if($shift) {{$shift->details}} @endif</textarea>
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
                                @if($shift) @if($shift->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                @if($shift) @if($shift->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection


