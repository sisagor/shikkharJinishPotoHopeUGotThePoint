@extends('layouts.modal', ['title' => 'edit_blog', 'size' => 'xl'])

@section('modal')

    <div class="showNotification"></div>
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
                                <option value="{{ $author->id }}" @if(! empty($blog))@if($blog->created_by == $author->id) selected @endif @endif>{{ $author->name }}</option>
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
                                <option value="{{ $id }}" @if(! empty($blog))@if($blog->blog_category_id == $id) selected @endif @endif>{{ $name }}</option>
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
                        <input class="form-control" id="title" name="title" value="{{$blog->title}}" required placeholder="{{trans('app.title')}}">
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
                                <option value="{{$key}}" @if(! empty($blog))@if($blog->status == $key) selected @endif @endif>{{$item}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            {{--Status--}}
            {{-- <div class="col-md-12 col-sm-12">
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
            </div> --}}


        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.tags')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.tags')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="tags" name="tags" value="{{$blog->seo->keywords}}" required placeholder="tag1,tag2,tag3,...">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="title">
                    {{trans('app.meta_description')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.meta_description')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="meta_description" name="meta_description" value="{{$blog->seo->description}}" required placeholder="Meta Description (max 160 characters)">
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
                    @php $book_1 = ''; $book_2 = ''; $book_3 = ''; $i=1; @endphp

                    @foreach($blog->books as $book)
                        @php ${'book_' . $i} = $book->book_id;  $i++;@endphp
                    @endforeach
                    <div class="col-md-4 col-sm-4">
                        <div class="item form-group">
                            <select class="form-control" name="books[]" id="book_1">
                                <option value="">{{trans('app.select')}}</option>
                                @foreach($books as $key => $book)
                                    <option value="{{ $book->id }}" @if(! empty($book_1))@if($book_1 == $key) selected @endif @endif>{{ $book->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item form-group">
                            <select class="form-control" name="books[]" id="book_3">
                                <option value="">{{trans('app.select')}}</option>
                                @foreach($books as $key => $book)
                                    <option value="{{$book->id }}" @if(! empty($book_2))@if($book_2 == $key) selected @endif @endif>{{  $book->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item form-group">
                            <select class="form-control" name="books[]" id="book_3">
                                 <option value="">{{trans('app.select')}}</option>
                                @foreach($books as $key => $book)
                                    <option value="{{ $book->id }}" @if(! empty($book_3))@if($book_3 == $key) selected @endif @endif>{{  $book->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="dynamic-fields">
            @foreach($blog->details as $detail)
            <div class="dynamic-block mt-3">
                <div class="dynamic-block-header">
                    Blog Details 
                    {{-- <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm float-right mr-2" id="add-field">Add More</button>
                        <button type="button" class="btn btn-danger btn-sm float-right remove-field">Remove</button>
                    </div> --}}
                </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="image">
                        {{ trans('app.image') }} (Size should be 770x500) <span class="required"></span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.image') }}"></i>
                    </label>
                    <div class="item form-group">
                        <input type="file" class="form-control" name="images[]" value="{{$detail->image->path}}" placeholder="{{ trans('app.image') }}">
                    </div>
                    <div> <img style="width: 100px; height: 100px;" src="{{get_storage_file_url(optional($detail->image)->path)}}" alt="Blog Image"></div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="col-form-label label-align" for="image_alter">
                        {{ trans('app.image_alter') }} <span class="required"></span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.image_alter') }}"></i>
                    </label>
                    <div class="item form-group">
                        <input type="text" class="form-control" name="images_alter[]" value="{{$detail->image->image_alter}}"  placeholder="{{ trans('app.image_alter') }}">
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
                                <option value="{{ $i }}" @if(! empty($detail))@if($detail->order == $i) selected @endif @endif>{{ $i }}</option>
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
                        <textarea class="form-control editor" name="details[]" placeholder="{{ trans('app.details') }}">{{ $detail->details}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

      </div>



    </div>

@endsection

@section('formScripts')
    @include('cms::scripts.formScript')
@endsection

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

</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    function initializeCKEditor(selector) {
            // Ensure CKEditor is not already initialized on this textarea
            if (!CKEDITOR.instances[selector.id]) {
                CKEDITOR.replace(selector);
            }
    }

    // Initialize CKEditor on all existing textareas when the document is ready
    $(document).ready(function() {
        // Initialize CKEditor for all existing textareas
        $('.editor').each(function() {
            initializeCKEditor(this);
        });
    });
</script>