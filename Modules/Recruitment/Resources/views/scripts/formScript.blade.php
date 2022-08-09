
<script type="text/javascript">
    ;(function ($, window, document) {

        $(document).ready(function () {

            console.log("working")
            //Summer Note
            $(".summernote").summernote({
                height: 150,
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
