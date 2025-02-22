@extends('layouts.modal', ['title' => 'edit_book', 'size' => 'md'])

@section('modal')

    <div class="showNotification"></div>

    <div class="row">
        <div class="form-body">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.name')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="name" class="form-control" type="text" name="name" value="{{$book->name}}" placeholder="{{trans('app.name')}}">
                </div>
            </div>

            {{--URL TYPE--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="url_type">
                    {{trans('app.url_type')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.url_type')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="url_type" id="url_type">
                        <option value="nofollow" @if($book->url_type == "nofollow") selected @endif>{{trans('app.nofollow')}}</option>
                        <option value="" @if($book->url_type == null) selected @endif >{{trans('app.dofollow')}}</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="url">
                    {{trans('app.url')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.url')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="url" class="form-control" type="text" name="url" value="{{$book->url}}" placeholder="{{trans('app.url')}}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="image">
                    {{trans('app.image')}} (Size should be 107x151) <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.image')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="image" class="form-control" type="file" name="image"  placeholder="{{trans('app.image')}}">
                </div>
                <div> <img style="width: 100px; height: 100px;" src="{{get_storage_file_url(optional($book->book)->path)}}" alt="Book Image"></div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="order">
                    {{trans('app.order')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.order')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="order" id="order">
                        <option value="">{{trans('app.select')}}</option>
                        @for($i=0;$i < 20;$i++)
                            <option value="{{$i}}" @if($book->order == $i) selected @endif> {{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.status')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(config('status.status') as $key => $item)
                            <option value="{{$key}}" @if($book->status == $key) selected @endif> {{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


        </div>
    </div>

@endsection