@extends('layouts.form', ['title' => 'new_blog'])

@section('buttons')
    {!! list_button('cms.blogs', 'blogs', 0) !!}
@endsection

@section('form')

    <style>
        .dynamic-block {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .dynamic-block-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .dynamic-block-header button {
            margin-left: 10px;
        }

        .cke_chrome {
            width: -moz-available!important;
            width: -webkit-fill-available!important;
        }
    </style>


    <div class="form-body">
        @if(auth()->user()->role_id == '1')
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <label class="col-form-label label-align" for="author_name">
                    {{trans('app.author_name')}} 
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.author_name')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="author_id">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($authors as $id => $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        <div class="row">

            <div class="col-md-4 col-sm-4">
                <label class="col-form-label label-align" for="parent_id">
                    {{trans('app.category')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.category')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="category_id" required>
                        <option value="">{{trans('app.select')}}</option>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" @if(! empty($blog))@if($blog->category_id == $id) selected @endif @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.title')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.title')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="title" name="title" required placeholder="{{trans('app.title')}}">
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-4 col-sm-4">
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
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.tags')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.tags')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="tags" name="tags" required placeholder="tag1,tag2,tag3,...">
                </div>
            </div>

            {{--URL TYPE--}}
           {{-- <div class="col-md-4 col-sm-4">
                <label class="col-form-label label-align" for="url_type">
                    {{trans('app.url_type')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.url_type')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="url_type" id="url_type">
                        <option value="nofollow">{{trans('app.nofollow')}}</option>
                        <option value="" selected>{{trans('app.dofollow')}}</option>
                    </select>
                </div>
            </div>--}}
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.meta_description')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.meta_description')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="meta_description" name="meta_description" required placeholder="Meta Description (max 160 characters)">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.books')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.books')}}"></i>
                </label>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="item form-group">
                            <select class="form-control" name="books[]" id="book_1">
                                <option value="">{{trans('app.select')}}</option>
                                @foreach($books as $key => $book)
                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item form-group">
                            <select class="form-control" name="books[]" id="book_3">
                                <option value="">{{trans('app.select')}}</option>
                                @foreach($books as $key => $book)
                                    <option value="{{$book->id }}" >{{  $book->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item form-group">
                            <select class="form-control" name="books[]" id="book_3">
                                 <option value="">{{trans('app.select')}}</option>
                                @foreach($books as $key => $book)
                                    <option value="{{ $book->id }}">{{  $book->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="dynamic-fields">
            <div class="dynamic-block mt-3">
                <div class="dynamic-block-header">
                    Blog Details 
                    <div class="text-end">
                        <button type="button" onclick="addDynamicFiled()" class="btn btn-primary btn-sm float-right mr-2" id="add-field">Add More</button>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="image">
                        {{ trans('app.image') }} (Size should be 770x500) <span class="required"></span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.image') }}"></i>
                    </label>
                    <div class="item form-group">
                        <input type="file" class="form-control" name="images[]"  placeholder="{{ trans('app.image') }}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="col-form-label label-align" for="image_alter">
                        {{ trans('app.image_alter') }} <span class="required"></span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.image_alter') }}"></i>
                    </label>
                    <div class="item form-group">
                        <input type="text" class="form-control" name="images_alter[]"  placeholder="{{ trans('app.image_alter') }}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="col-form-label label-align" for="details">
                        {{ trans('app.order') }} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.order') }}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" name="orders[]" required>
                            <option value="">{{ trans('app.select') }}</option>
                            @for($i = 1; $i <= 15; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="details">
                        {{ trans('app.details') }} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.details') }}"></i>
                    </label>
                    <div class="item form-group">
                        <textarea class="form-control editor" id="initialEditor" name="details[]" placeholder="{{ trans('app.details') }}"></textarea>
                    </div>
                </div>
            </div>
        </div>
      </div>
        {{-- <button type="button" class="btn btn-primary" id="add-field">Add More</button> --}}

    </div>

@endsection


@section('formScripts')
    @include('cms::scripts.formScript')
@endsection


