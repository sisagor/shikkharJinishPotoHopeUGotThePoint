@extends('layouts.modal', ['title' => 'new_book', 'size' => 'md'])

@section('modal')

    <div class="showNotification"></div>

    <div class="row">
        <div class="form-body">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="url">
                    {{trans('app.url')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.url')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="url" class="form-control" type="text" name="url" placeholder="{{trans('app.url')}}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="image">
                    {{trans('app.image')}} (Size should be 107x151) <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.image')}}"></i>
                </label>
                <div class="item form-group">
                    <input id="image" class="form-control" type="file" name="image"
                            placeholder="{{trans('app.image')}}">
                </div>
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
                            <option value="{{$i}}"> {{$i}}</option>
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
                            <option value="{{$key}}"> {{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


        </div>
    </div>

@endsection



