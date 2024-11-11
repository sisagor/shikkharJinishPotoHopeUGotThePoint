@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.title')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.title')}}">
                    </i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="title" name="title" placeholder="{{trans('app.title')}}" required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.employment_type_name')}}">
                    </i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="name" name="name" placeholder="{{trans('app.name')}}" required/>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.details')}}">
                    </i>
                </label>
                <div class="item form-group">
                    <textarea class="form-control" id="details" name="details" required></textarea>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="image">
                    {{ trans('app.image') }} (Size should be 107x151) <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                    title="{{ trans('help.image') }}"></i>
                </label>
                <div class="item form-group">
                    <input type="file" class="form-control" name="images" required placeholder="{{ trans('app.image') }}">
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
                            <option value="{{$key}}">{{$item}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection


