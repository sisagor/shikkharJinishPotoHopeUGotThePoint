{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {
            //datatables
            let smsTable = $('.sms-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!!  route('notification.sms.logs') !!}',
                    data: function (d) {
                        if ($('#company-filter').length) {
                            d.company_id = $('#company-filter').val();
                        }
                        if ($('#branch-filter').length) {
                            d.branch_id = $('#branch-filter').val();
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
                    {data: 'phone', name: 'phone'},
                    {data: 'sms', name: 'sms'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });



            $('#company-filter').on('change', function () {
                pendingSalary.ajax.reload();
                approvedSalary.ajax.reload();
            });

            $('#branch-filter').on('change', function () {
                pendingSalary.ajax.reload();
                approvedSalary.ajax.reload();
            });
            /* $('#department-filter').on('change', function () {
                 attendanceTable.ajax.reload();
             });*/
            $('#month-filter').on('change', function () {
                pendingSalary.ajax.reload();
                approvedSalary.ajax.reload();
            });


        });
    }(window.jQuery, window, document));
</script>
