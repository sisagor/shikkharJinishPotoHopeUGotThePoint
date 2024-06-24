@extends('layouts.viewModal', ['title' => 'view_job', 'size' => 'lg'])

@section('viewModal')

    <div class="showNotification"></div>

    <div class="form-body">
        {{--Status--}}
        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="key">
                {{trans('app.content_type')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.content_type')}}"></i>
            </label>
            <div class="item form-group">
                <select class="form-control" name="type" id="key" readonly>
                    <option value="">{{trans('app.select')}}</option>
                    @foreach(config('recruitment.content_type') as $type)
                        <option value="{{$type['key']}}"
                                @if($cms) @if($type['key'] == $cms->type) selected @endif @endif> {{$type['value']}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{--Status--}}
        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="status">
                {{trans('app.status')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.status')}}"></i>
            </label>
            <div class="item form-group">
                <select class="form-control" name="status" id="status" readonly>
                    <option value="">{{trans('app.select')}}</option>
                    <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                            @if($cms)@if(\App\Models\RootModel::STATUS_ACTIVE == $cms->status) selected @endif @endif> Active
                    </option>
                    <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                            @if($cms)@if(\App\Models\RootModel::STATUS_INACTIVE == $cms->status) selected @endif @endif> Inactive
                    </option>
                </select>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="body">
                {{trans('app.body')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.body')}}"></i>
            </label>
            <div class="item form-group" readonly="">
                <textarea  id="offer_details" class="form-control summernote w-100" name="content" readonly placeholder="{{trans('app.content')}}">@if($cms){!! json_decode($cms->content) !!}@endif</textarea>
            </div>
        </div>

        {{-- <div class="col-md-12 col-sm-12">
             <label class="col-form-label label-align" for="body">
                 {{trans('app.body')}} <span class="required">*</span>
                 <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                    title="{{ trans('help.body')}}"></i>
             </label>
             <div class="item form-group">
                 <textarea style="min-height: 200px; width: 100%"  id="editor" class="form-control " name="content" placeholder="{{trans('app.content')}}">@if($cms){!! json_decode($cms->content) !!}@endif</textarea>
             </div>
         </div>--}}
    </div>

@endsection

@include('recruitment::scripts.formScript')



