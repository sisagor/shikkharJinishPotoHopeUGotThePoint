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

        $(document).ready(function() {

            $('#initialEditor').each(function() {
                initializeCKEditor(this);
            });

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