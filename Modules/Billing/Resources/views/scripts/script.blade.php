{{--<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {
            //Ajax get dependent dropdown
            //Check if employee create User
            var total = 0;

            $('#total').on('click', function(){

                let mobileBill = parseInt($('#mobile_bill').val());
                let allowance = parseInt($('#allowance').val());
                let otherBill = parseInt($('#other_bill').val());

                if(mobileBill > 0 || allowance > 0 || otherBill > 0 ){
                    $('#total').val((mobileBill + allowance + otherBill));
                }
                else
                {
                    $('#total').val(0);
                }
            })

        });

    }(window.jQuery, window, document));

</script>
