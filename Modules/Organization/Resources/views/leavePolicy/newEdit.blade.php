@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">
            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="type_id">
                    {{trans('app.leave_type')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.leave_type')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-dropdown" name="type_id[]" id="type_id" multiple>
                        <option value="">{{trans('app.select')}}</option>

                        @if($policy)
                            @foreach($policy->type_id as $type)
                                <option value="{{$type->id}}" selected> {{ $type->name.' : '.$type->days }}</option>
                            @endforeach
                        @endif

                        @foreach(get_leave_types() as $key =>  $item)
                            <option value="{{$key}}">
                                {{$item}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="apply_at">
                    {{trans('app.apply_at')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.apply_at')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="apply_at" id="apply_at">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(config('organization.apply_at') as $key =>  $item)
                            <option value="{{$key}}" @if($policy) @if($policy->apply_at == $key) selected @endif @endif>
                                {{$item}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.policy_name')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.name')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="name" name="name" required
                           value="@if($policy){{$policy->name}}@endif" placeholder="{{trans('app.policy_name')}}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.details')}}"></i>
                </label>
                <div class="item form-group">
                    <textarea id="details" class="form-control" type="text" name="details">@if($policy){{$policy->details}}@endif</textarea>
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{trans('help.status')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                                @if($policy) @if($policy->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                @if($policy) @if($policy->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection


