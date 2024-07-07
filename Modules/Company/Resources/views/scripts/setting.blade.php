{{--<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {
            //Ajax get dependent dropdown
            //Check if employee create User
           /* $('#has_provident_fund').on('ifChanged', function () {

                if ($('#has_provident_fund').is(':checked')) {

                    $('.providentFund').css('display', 'block');
                } else {
                    $('.providentFund').css('display', 'none');
                }
            });*/

           /* $('#has_insurance').on('ifChanged', function () {

                if ($('#has_insurance').is(':checked')) {

                    $('.hasInsurance').css('display', 'block');
                } else {
                    $('.hasInsurance').css('display', 'none');
                }
            });*/

            $('#attendance_type').on('change', function (){

                if ($('#attendance_type').val() == "ip_based")
                {
                    $('.device_ip').removeClass('hide')
                    $('.device_ip').addClass('show')
                }
                else
                {
                    $('.device_ip').addClass('hide')
                    $('.device_ip').removeClass('show')
                }
            })
        });

    }(window.jQuery, window, document));

</script>
