{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            let notificationTable = $('.notification-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!!  route('notifications') !!}',
                    data: function (d) {
                        if ($('#company-filter').length) {
                            d.company_id = $('#company-filter').val();
                        }
                        if ($('#employee-filter').length) {
                            d.employee_id = $('#employee-filter').val();
                        }
                        if ($('#month-filter').length) {
                            d.month = $('#month-filter').val();
                        }
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: ['{{config('system_settings.pagination')}}', 25, 50, 75, 100],
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employee_index'},
                    {data: 'employee_name', name: 'employee_name'},
                    {data: 'machine_ip', name: 'machine_ip'},
                    {data: 'checkin_time', name: 'checkin_time'},
                    {data: 'checkout_time', name: 'checkout_time'},
                    {data: 'attendance_date', name: 'attendance_date'},
                    {data: 'working_hour', name: 'working_hour'},
                    {data: 'late', name: 'late'},
                    {data: 'overtime', name: 'overtime'},
                    {data: 'actions', name: 'actions'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            $('#company-filter').on('change', function () {
                notificationTable.ajax.reload();
            });

            $('#month-filter').on('change', function () {
                notificationTable.ajax.reload();
            });


        });
    }(window.jQuery, window, document));
</script>
