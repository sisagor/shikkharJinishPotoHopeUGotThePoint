<style>
    legend {
        margin-bottom: 0rem !important;
    }
</style>

{{--Form content--}}
<form method="post" enctype="multipart/form-data" action="{{ route(session('action'))}}">
    @csrf
    <input type="hidden" name="general" value="general"/>
    <div class="clearfix"></div>
    <div class="col-md-6 col-sm-6">
        <fieldset>
            <legend>{{ trans('app.social_settings') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                   title="{{ trans('help.social_settings')}}"></i>
            </legend>
            <div class="col-md-12 col-sm-12">

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="facebook">
                        {{trans('app.facebook')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.facebook')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="facebook" name="facebook">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="tweeter">
                        {{trans('app.tweeter')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.tweeter')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="tweeter" name="tweeter">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="instagram">
                        {{trans('app.instagram')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.instagram')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="instagram" name="instagram">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <label class="col-form-label label-align" for="pinterest">
                        {{trans('app.pinterest')}}
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('help.pinterest')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="pinterest" name="pinterest">
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
