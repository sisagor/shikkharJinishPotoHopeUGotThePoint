@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.name')}}">
                    </i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="name" name="name" value="@if(!empty($blogCategory)){{$blogCategory->name}}@endif"
                           placeholder="{{trans('app.name')}}" required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.details')}}">
                    </i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="details" name="details" required>@if($blogCategory){{$blogCategory->details}}@endif</textarea>
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        @foreach(config('status.status') as $key => $item)
                            <option value="{{$key}}" @if($blogCategory->status)@if($blogCategory->status == $key) selected @endif @endif>{{$item}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection


