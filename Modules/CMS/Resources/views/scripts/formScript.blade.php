
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

<script type="text/javascript">
    ;(function ($, window, document) {

        $(document).ready(function () {
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

        });

        $(document).ready(function() {
            $('#add-field').click(function() {
                var newField = $('#dynamic-fields .dynamic-block:first').clone();
                newField.find('input, select, textarea').val('');
                newField.find('.remove-field').show();
                newField.find('#add-field').hide();
                $('#dynamic-fields').append(newField);
            });

            $(document).on('click', '.remove-field', function() {
                $(this).closest('.dynamic-block').remove();
            });

            // Hide remove button for the first set of fields
            $('#dynamic-fields .remove-field').hide();
        });


    }(window.jQuery, window, document));


</script>
