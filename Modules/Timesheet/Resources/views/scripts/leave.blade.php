<script>

    $(document).ready(function () {

        $('#leave_for').on('change', function () {
            if ($(this).val() == '{{config('timesheet.type_days.value')}}') {
                $('.daysDate').removeClass('hide');
                $('.daysDate').addClass('show');
                $('.hourDate').addClass('hide');
            }
            if ($(this).val() == '{{config('timesheet.type_hour.value')}}') {
                $('.hourDate').removeClass('hide');
                $('.hourDate').addClass('show');
                $('.daysDate').addClass('hide');
            }
        });

        //Search for Product Test here
        $('#employee_id').on('change', function () {

            $.ajax({
                url: '{{route('timesheet.leave.getLeaveType')}}?empId=' + $('#employee_id').val(),
                contentType: 'application/json',
                method: 'get',
            }).success(function (result) {
                for (i = 0; i < result.length; i++) {
                    $('#leave_type').append(''
                        + '<option value="' + result[i].id + '">' + result[i].name
                        + '</option>'
                        + '');
                }
            });

        });

        //End of the auto execution;
    });

</script>
