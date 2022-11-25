{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            //Set type
            let type = $('#type')
            let incrementYear = $('#increment_year');
            let efficientBarYear = $('#efficient_bar_year');

            type.on('change', function (){

                if(this.value == "increment")
                {
                    incrementYear.removeClass('hide')
                    incrementYear.addClass('show')
                }
                else
                {
                    incrementYear.addClass('hide')
                }
                if(this.value == "efficient_bar")
                {
                    efficientBarYear.removeClass('hide')
                    efficientBarYear.addClass('show')
                }
                else
                {
                    efficientBarYear.addClass('hide')
                }
            })
            //End set type






        });
    }(window.jQuery, window, document));
</script>
