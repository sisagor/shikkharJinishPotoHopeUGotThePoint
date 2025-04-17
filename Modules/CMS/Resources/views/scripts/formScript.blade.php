<script>
 /*   ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );*/
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script type="text/javascript">
    ;(function ($, window, document) {

        /*$(document).ready(function () {
            //Summer Note
            $(".summernote").summernote({
                height: 130,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'list']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul','ol','paragraph']],
                    ["view", ["fullscreen", "codeview"]]
                ],
            });

            $('.card').css('width', '100%');

        });*/

        $(document).ready(function() {

            $('#initialEditor').each(function() {
                initializeCKEditor(this);
            });

          /*  $('#add-field').click(function()
            {
                // var newField = $('#dynamic-fields .dynamic-block:first').clone();
                // newField.find('input, select, textarea').val('');
                // newField.find('.remove-field').show();
                // newField.find('#add-field').hide();
                // $('#dynamic-fields').append(newField);
                // CKEDITOR.replace(newTextarea[0]);

                var newField = $('#dynamic-fields .dynamic-block:first').clone();

                // Reset the values of input, select, and textarea
                newField.find('input, select, textarea').val('');

                // Show the remove button and hide the add button
                newField.find('.remove-field').show();
                newField.find('#add-field').hide();

                // Append the new field to the container
                $('#dynamic-fields').append(newField);

                var newTextarea = newField.find('textarea')[0];
                        
                // Initialize CKEditor only if it's not already initialized
                if (!CKEDITOR.instances[newTextarea.id]) {
                    initializeCKEditor(newTextarea);
                }
            });


            $(document).on('click', '.remove-field', function() {
                $(this).closest('.dynamic-block').remove();
            });

            // Hide remove button for the first set of fields
            $('#dynamic-fields .remove-field').hide();*/
        });



        function initializeCKEditor(selector) {
            // Ensure CKEditor is not already initialized on this textarea
            if (!CKEDITOR.instances[selector.id]) {
                CKEDITOR.replace(selector);
            }
        }

    }(window.jQuery, window, document));



    var counter = 1;

    function addDynamicFiled(){
        counter = counter + 1;
        $.ajax({
            "url" : '{{route('cms.blog.getSingleDetails')}}',
            "type": "post",
            "content-type" : "application/json",
            "data" : {"counter" : counter}
        }).done(function(result)
        {
            $('#dynamic-fields').append(result);

        }).fail(function(error)
        {
            console.log(error)
        });

    }


</script>
