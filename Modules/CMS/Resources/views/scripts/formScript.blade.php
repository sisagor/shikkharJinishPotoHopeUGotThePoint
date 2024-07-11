
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


            //End search for product

        });


    }(window.jQuery, window, document));


</script>
