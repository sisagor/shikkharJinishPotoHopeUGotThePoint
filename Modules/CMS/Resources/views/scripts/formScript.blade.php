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
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script type="text/javascript">
    ;(function ($, window, document) {

        $(document).ready(function() {

            $('.initialEditor').each(function () {
                CKEDITOR.replace(this); // ✅ this is a valid DOM element
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