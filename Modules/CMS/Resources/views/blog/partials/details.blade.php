<div class="dynamic-block mt-3">
    <div class="dynamic-block-header">
        Blog Details
        <div class="text-end">
            <button type="button" class="btn btn-danger btn-sm float-right remove-field">Remove</button>
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
                <input type="file" class="form-control" name="images[]" placeholder="{{ trans('app.image') }}">
            </div>
        </div>


        <div class="col-md-3 col-sm-3">
            <label class="col-form-label label-align" for="image_alter">
                {{ trans('app.image_alter') }} <span class="required"></span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.image_alter') }}"></i>
            </label>

            <div class="item form-group">
                <input type="text" class="form-control" name="images_alter[]"
                       placeholder="{{ trans('app.image_alter') }}">
            </div>
        </div>


        <div class="col-md-3 col-sm-3">
            <label class="col-form-label label-align" for="details">
                {{ trans('app.order') }} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.order') }}"></i>
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
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.details') }}"></i>
            </label>


            <div class="item form-group">
                <textarea class="form-control editor{{$counter}}" id="newDetails{{$counter}}" name="details[]"
                          placeholder="{{ trans('app.details') }}"></textarea>
            </div>

        </div>
    </div>
</div>








<script type="text/javascript">

    ;(function ($, window, document) {

        $(document).ready(function() {

            var counter = '{{$counter}}';



            $('#newDetails'+counter).each(function() {
                initCK(this);
            });



            $('.remove-field').on('click', function() {
                $(this).closest('.dynamic-block').remove();
            });
        });



        function initCK(selector)
        {
            // Initialize CKEditor only if it's not already initialized
            if (!CKEDITOR.instances[selector]) {
                CKEDITOR.replace(selector);
            }
        }

    }(window.jQuery, window, document));


</script>




