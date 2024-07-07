<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            $('#loan_type').on('change', function () {

                if ($('#loan_type').val() == '{{\Modules\Loan\Entities\Loan::TYPE_LOAN}}'){

                    $('#interestPercent').removeClass('hide')
                    $('#interestPercent').addClass('show')
                }
                else
                {
                    $('#interestPercent').removeClass('show')
                    $('#interestPercent').addClass('hide')
                    $('#interest_percent').val(0);
                }
            });

            $('#installments').on('keyup', function () {

                var interestPercent = parseInt($('#interest_percent').val());
                var installment =  parseInt($('#installments').val());
                var loanAmount =  parseInt($('#loan_amount').val());
                var installmentAmount = 0;

                if (interestPercent > 0 ){
                    let interest  = (interestPercent * loanAmount / 100);
                    installmentAmount = ((loanAmount + interest) / installment);
                }
                else
                {
                    installmentAmount = (loanAmount / installment );
                }

                $('#installment_amount').val(installmentAmount);

            })

            //check employee provision period is over.
            $('.checkProvision').on('change', () =>{

                $.ajax({
                    url : '{{route('employee.checkProvision')}}'+'?id='+$('.checkProvision').val(),
                    type:'GET',
                    contentType: 'application/json'
                }).success(function (response) {
                    if (! response){
                        {{--@include('scripts.notify', ['type' => 'warning', 'msg' => trans('msg.provision_period_warning')])--}}
                       {{-- let msg = @include('scripts.notify',
                        [
                            'msg' => trans('msg.provision_period_warning'),
                            'type' => 'warning',
                        ])--}}
                        let msg = '{{trans('msg.provision_period_warning')}}';
                        showNotification('warning', msg);

                        $('#submitButton').removeClass('show')
                        $('#submitButton').addClass('hide')
                    }
                    else
                    {
                        $('#submitButton').removeClass('hide')
                        $('#submitButton').addClass('show')
                    }
                })


            });
            //End search for product


        });


    }(window.jQuery, window, document));

</script>
