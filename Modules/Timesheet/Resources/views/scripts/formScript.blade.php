{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            //get Shift on select employee
            $('#parent_id').on('change', function () {
                $.ajax({
                    url: '{{route('componentSettings.getShiftViaId')}}?id=' + $(this).val(),
                    method: 'get',
                    contentType: 'application/json'
                }).success(function (response) {

                    if (response) {
                        $('#checkin_time').text(response.startTime);
                        $('#checkout_time').text(response.endTime);

                        $('.shiftTime').removeClass('hide')
                        $('.shiftTime').addClass('show')
                    }
                })
            });

        });
    }(window.jQuery, window, document));
</script>
