<style>
    legend {
        margin-bottom: 0rem !important;
    }
</style>

{{--Form content--}}
<form method="post" enctype="multipart/form-data" action="{{ route('settings.seoStore')}}">
    @csrf
    <input type="hidden" name="seo" value="{{ $seo->id }}"/>
    <div class="clearfix"></div>
    <legend>{{ trans('app.update_seo') }}
        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
           title="{{ trans('help.update_seo')}}"></i>
    </legend>
    <div class="col-md-6 col-sm-6">
        <fieldset>
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="slug">
                        {{trans('app.slug')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.slug')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="slug" name="slug"
                               required
                               value="{{$seo->slug}}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="system_phone">
                        {{trans('app.title')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.title')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="title"
                               name="title" required
                               value="{{ $seo->title }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="author">
                        {{trans('app.author_name')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.author')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="author"
                               name="author" required
                               value="{{ $seo->author }}">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="keywords">
                        {{trans('app.keywords')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.keywords')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="keywords"
                               name="keywords" required
                               value="{{ $seo->keywords }}">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="section">
                        {{trans('app.section')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.section')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="section"
                               name="section" required
                               value="{{ $seo->section }}">
                    </div>
                </div>
              

            </div>
        </fieldset>
    </div>


    <div class="col-md-6 col-sm-6">
        <fieldset class="">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="canonical">
                        {{trans('app.canonical')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.canonical')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="author"
                               name="canonical" required
                               value="{{ $seo->canonical }}">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="og_locale">
                        {{trans('app.og_locale')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.og_locale')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="og_locale"
                               name="og_locale" required
                               value="{{ $seo->og_locale }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="og_url">
                        {{trans('app.og_url')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.og_url')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="og_url" name="og_url"
                               required
                               value="{{ $seo->og_url }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="og_type">
                        {{trans('app.og_type')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.og_type')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="og_type" name="og_type"
                               required
                               value="{{ $seo->og_type }}">
                    </div>
                </div>

            </div>

        </fieldset>
    </div>
    <div class="col-md-12 col-sm-12">
        <fieldset class="mt-2">
            <div class="col-md-12 col-sm-12">

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="description">
                        {{trans('app.description')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.description')}}"></i>
                    </label>
                    <div class="item form-group">
                        <textarea id="description" class="form-control" name="description">{{ $seo->description }}</textarea>
                    </div>
                </div>
            </div>

        </fieldset>
    </div>

    <div class="clearfix"></div>
    <div class="ln_solid">
        <div class="form-group">
            <div class="col-md-6 offset-md-5" style="padding: 15px 0px 0px 10px;">
                <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                        value="1" class="btn btn-primary"> {{trans('app.update')}}
                </button>
                <button type="reset" id="resetButton" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </div>
</form>

{{--End Form content--}}
