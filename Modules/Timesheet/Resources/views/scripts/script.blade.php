{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/

        $(document).ready(function () {
            //datatables
            let leavePending = $('.leave-application-pending').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!! route('timesheet.leaves') !!}',
                    data: function (d) {
                        filterData(d);
                    }
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'first_name', name: 'employees.first_name'},
                    {data: 'last_name', name: 'employees.last_name'},
                    {data: 'type_name', name: 'type_name'},
                    {data: 'leave_for', name: 'leave_for'},
                    {data: 'leave_days', name: 'leave_days'},
                    {data: 'leave_hour', name: 'leave_hour'},
                    {data: 'approval_status', name: 'approval_status'},
                    @if(! is_employee())
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    @endif
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            /*leave-application-rejected leave*/
            let leaveRejected = $('.leave-application-rejected').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!! route('timesheet.leave.rejected') !!}',
                    type: 'GET',
                    data: function (d) {
                        filterData(d);
                    }
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'first_name', name: 'employees.first_name'},
                    {data: 'last_name', name: 'employees.last_name'},
                    {data: 'type_name', name: 'type_name'},
                    {data: 'leave_for', name: 'leave_for'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'leave_days', name: 'leave_days'},
                    {data: 'leave_hour', name: 'leave_hour'},
                    {data: 'approval_status', name: 'approval_status'},
                    {data: 'approved_by', name: 'approved_by'},
                    {data: 'details', name: 'details'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            })

            /*Approved leave*/
            let leaveApproved = $('.leave-application-approve').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    type: 'GET',
                    url: '{!! route('timesheet.leave.approved') !!}',
                    data: function (d) {
                        filterData(d);
                    }
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'first_name', name: 'employees.first_name'},
                    {data: 'last_name', name: 'employees.last_name'},
                    {data: 'type_name', name: 'type_name'},
                    {data: 'leave_for', name: 'leave_for'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'leave_days', name: 'leave_days'},
                    {data: 'leave_hour', name: 'leave_hour'},
                    {data: 'approval_status', name: 'approval_status'},
                    {data: 'approved_by', name: 'approved_by'},
                    {data: 'details', name: 'details'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            //now punch log is perfect*/
            let punchLog = $('.punchLog-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!!  route('timesheet.punchLog') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'first_name', name: 'employees.first_name'},
                    {data: 'last_name', name: 'employees.last_name'},
                    {data: 'device_ip', name: 'device_ip'},
                    {data: 'punch_time', name: 'punch_time'},
                    {data: 'date', name: 'date'},
                    {data: 'location', name: 'location'},
                    {data: 'actions', name: 'actions'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            ///Attendance Table now perfect
            let attendanceTable = $('.attendance-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!!  route('timesheet.attendances') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'first_name', name: 'employees.first_name'},
                    {data: 'last_name', name: 'employees.last_name'},
                    {data: 'device_ip', name: 'device_ip'},
                    {data: 'checkin_time', name: 'checkin_time'},
                    {data: 'checkout_time', name: 'checkout_time'},
                    {data: 'attendance_date', name: 'attendance_date'},
                    {data: 'working_hour', name: 'working_hour'},
                    {data: 'late', name: 'late'},
                    {data: 'overtime', name: 'overtime'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            //Absent Log//
            let absentTable = $('.attendance-absent').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!!  route('timesheet.absent') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employees.employee_index'},
                    {data: 'first_name', name: 'employees.first_name'},
                    {data: 'last_name', name: 'employees.last_name'},
                    {data: 'attendance_date', name: 'attendance_date'},
                    {data: 'status', name: 'status'},
                   /* {data: 'actions', name: 'actions'},*/
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            ///On leave Employee
            let attendanceOnLeave = $('.attendance-onLeave').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!!  route('timesheet.onLeave') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employee_index'},
                    {data: 'first_name', name: 'employees.first_name'},
                    {data: 'last_name', name: 'employees.last_name'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'leave_days', name: 'leave_days'},
                    {data: 'type', name: 'leave_types.type'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            $('#company-filter').on('change', function () {
                attendanceTable.ajax.reload();
                leaveApproved.ajax.reload();
                leaveRejected.ajax.reload();
                leavePending.ajax.reload();
                punchLog.ajax.reload();
                absentTable.ajax.reload();
                attendanceOnLeave.ajax.reload();
            });

            $('#branch-filter').on('change', function () {
                attendanceTable.ajax.reload();
                leaveApproved.ajax.reload();
                leaveRejected.ajax.reload();
                leavePending.ajax.reload();
                punchLog.ajax.reload();
                absentTable.ajax.reload();
                attendanceOnLeave.ajax.reload();
            });

            $('#employee-filter').on('change', function () {
                attendanceTable.ajax.reload();
                leaveApproved.ajax.reload();
                leaveRejected.ajax.reload();
                leavePending.ajax.reload();
                punchLog.ajax.reload();
                absentTable.ajax.reload();
                attendanceOnLeave.ajax.reload();
            });

            $("#from-date-filter").datepicker({
                onSelect: function(dateText) {
                    attendanceTable.ajax.reload();
                    leaveApproved.ajax.reload();
                    leaveRejected.ajax.reload();
                    leavePending.ajax.reload();
                    punchLog.ajax.reload();
                    absentTable.ajax.reload();
                    attendanceOnLeave.ajax.reload();
                }
            });

            $("#to-date-filter").datepicker({
                onSelect: function(dateText) {
                    attendanceTable.ajax.reload();
                    leaveApproved.ajax.reload();
                    leaveRejected.ajax.reload();
                    leavePending.ajax.reload();
                    punchLog.ajax.reload();
                    absentTable.ajax.reload();
                    attendanceOnLeave.ajax.reload();
                }
            });


        });
    }(window.jQuery, window, document));

</script>
