{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {
            var incrementYears = '{{config('company_settings.increment_year')}}';
            var efficientBarYears = '{{config('company_settings.efficient_bar_year')}}';
            //Set type
            var type = $('#type')
            var incrementLoop = $('#increment_year');

            type.on('change', function (){

                if(this.value == "increment")
                {
                    let loop = '';
                   /* incrementYear.removeClass('hide')
                    incrementYear.addClass('show')*/
                    incrementLoop.empty().append('<option selected value="">--select--</option>')
                    for(let i = 0; i <= incrementYears; i++){
                        loop +='<option value="'+ i +'"> '+ i +'</option>';
                    }
                    incrementLoop.append(loop)
                }

                if(this.value == "efficient_bar")
                {
                    let loop = '';
                    incrementLoop.empty().append('<option selected value="">--select--</option>')
                    for(let i = 0; i <= efficientBarYears; i++){
                        loop +='<option value="'+ i +'"> '+ i +'</option>';
                    }
                    incrementLoop.append(loop)
                }

            })
            //End set type


            //ajax for getting calculation
            $('#increment_year').on('change', () => {

                $.ajax({
                    'method' : 'get',
                    'url' : '{{route('payroll.rule.grade')}}?type='+ type.val() +'&year='+ incrementLoop.val()+'&rule_id='+$('#grade').val(),
                })
                .success((response) =>
                {
                    if(response.status == 1)
                    {
                        $('#rule_details').html(response.data)
                        $('#rule_total').html(response.total)
                    }
                    else
                    {
                        @include('scripts.notification',
                        [
                            'title' => trans('msg.error'),
                            'msg' => trans('msg.required', ['filed' => "Salary rule, Type and year"]),
                            'type' => 'warning',
                        ])
                    }
                })
            })





        });
    }(window.jQuery, window, document));
</script>
