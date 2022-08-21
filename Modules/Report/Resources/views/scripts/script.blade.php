{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            //Leave applications
            let leaveApplications = $('.leave-application').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!! route('reports.leave') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: ReportPaginationLengthMenu(),
                pageLength: {{config('system_settings.report_pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'name', name: 'employees.name'},
                    {data: 'type_name', name: 'type_name'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'leave_days', name: 'leave_days'},
                    {data: 'details', name: 'details'},
                    {data: 'approval_status', name: 'approval_status'},
                    {data: 'approved_by', name: 'approved_by'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            ///Attendance Table now perfect
            let attendanceTable = $('.report-attendance-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!!  route('reports.attendance') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: ReportPaginationLengthMenu(),
                pageLength: {{config('system_settings.report_pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'name', name: 'employees.name'},
                    {data: 'device_ip', name: 'device_ip'},
                    {data: 'checkin_time', name: 'checkin_time'},
                    {data: 'checkout_time', name: 'checkout_time'},
                    {data: 'attendance_date', name: 'attendance_date'},
                    {data: 'working_hour', name: 'working_hour'},
                    {data: 'late', name: 'late'},
                    {data: 'overtime', name: 'overtime'},
                    {data: 'status', name: 'status'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });



            ///Attendance Table Month Wise perfect

            let days = '{{@$days}}';

            let column = [
                {data: 'employee_index', name: 'employee_index'},
                {data: 'name', name: 'name', orderable: false},
            ];

            for (let i=0; i < days; i++){
                column.push({data: i, name: i, orderable: false, searchable: false});
            }

            column.push(
                {data: 'present', name: 'present', orderable: false, searchable: false},
                {data: 'leave_holiday', name: 'leave_holiday', orderable: false, searchable: false},
                {data: 'absent', name: 'absent', orderable: false, searchable: false},
            );

            let attendanceTableMonthWise = $('.report-attendance-month-wise-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!!  route('reports.attendanceMonthWise') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: ReportPaginationLengthMenu(),
                pageLength: {{config('system_settings.report_pagination')}},
                columns: column,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            //End month wise attendance report;



            /**salary*/
            let salaryTable = $('.salary-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!!  route('reports.salary') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu:ReportPaginationLengthMenu(),
                pageLength: {{config('system_settings.report_pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'name', name: 'employees.name'},
                    {data: 'month', name: 'month'},
                    {data: 'basic_salary', name: 'basic_salary'},
                    {data: 'allowance', name: 'allowance'},
                    {data: 'deduction', name: 'deduction'},
                    {data: 'other_allowance', name: 'other_allowance'},
                    {data: 'other_deduction', name: 'other_deduction'},
                    {data: 'total', name: 'total'},
                    {data: 'paid_amount', name: 'paid_amount'},
                    {data: 'due_amount', name: 'due_amount'},
                    {data: 'is_paid', name: 'is_paid'},
                    /*{data: 'action', name: 'action', orderable: false, searchable: false},*/
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            $('#company-filter').on('change', function () {
                attendanceTable.ajax.reload();
                leaveApplications.ajax.reload();
                salaryTable.ajax.reload();
                attendanceTableMonthWise.ajax.reload();
            });

            $('#branch-filter').on('change', function () {
                attendanceTable.ajax.reload();
                leaveApplications.ajax.reload();
                salaryTable.ajax.reload();
                attendanceTableMonthWise.ajax.reload();

            });

          /*  $('#month-filter').on('change', function () {
                attendanceTableMonthWise.ajax.reload();
            });*/

            $('#month-filter').on('change', function () {
                attendanceTable.ajax.reload();
                leaveApplications.ajax.reload();
                salaryTable.ajax.reload();
            });

            $("#from-date-filter").datepicker({
                onSelect: function(dateText) {
                    attendanceTable.ajax.reload();
                    leaveApplications.ajax.reload();
                }
            });

            $("#to-date-filter").datepicker({
                onSelect: function(dateText) {
                    attendanceTable.ajax.reload();
                    leaveApplications.ajax.reload();
                }
            });

            $('#status-filter').on('change', function () {
                attendanceTable.ajax.reload();
                leaveApplications.ajax.reload();
            });


        });
    }(window.jQuery, window, document));

</script>
