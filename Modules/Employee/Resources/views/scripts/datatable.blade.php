<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            let active = $('.active-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!! route('employee.employees').'?type=active' !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employee_index'},
                    {data: 'department', name: 'department', searchable: false},
                    {data: 'designation', name: 'designation', searchable: false},
                    {data: 'employee_type', name: 'employee_type', searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'device_id', name: 'device_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            let trash = $('.trash-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!! route('employee.employees').'?type=trash' !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employee_index'},
                    {data: 'department', name: 'department', searchable: false},
                    {data: 'designation', name: 'designation', searchable: false},
                    {data: 'employee_type', name: 'employee_type', searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'device_id', name: 'device_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });



            let inactiveActive = $('.inactive-table-active').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!! route('employee.employees.inactive').'?type=active' !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employee_index'},
                    {data: 'department', name: 'department', searchable: false},
                    {data: 'designation', name: 'designation', searchable: false},
                    {data: 'employee_type', name: 'employee_type', searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'device_id', name: 'device_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            let inactiveTrash = $('.inactive-table-trash').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: {
                    url: '{!! route('employee.employees.inactive').'?type=trash' !!}',
                    data: function (d) {
                        filterData(d);
                    },
                    type: 'GET',
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: paginationLengthMenu(),
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_index', name: 'employee_index'},
                    {data: 'department', name: 'department', searchable: false},
                    {data: 'designation', name: 'designation', searchable: false},
                    {data: 'employee_type', name: 'employee_type', searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'device_id', name: 'device_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('#company-filter').on('change', function () {
                active.ajax.reload();
                inactiveActive.ajax.reload();
                inactiveTrash.ajax.reload();
                trash.ajax.reload();
            });

            $('#branch-filter').on('change', function () {
                active.ajax.reload();
                inactiveActive.ajax.reload();
                inactiveTrash.ajax.reload();
                trash.ajax.reload();
            });

            $('#department-filter').on('change', function () {
                active.ajax.reload();
                inactiveActive.ajax.reload();
                inactiveTrash.ajax.reload();
                trash.ajax.reload();
            });

            $('#designation-filter').on('change', function () {
                active.ajax.reload();
                inactiveActive.ajax.reload();
                inactiveTrash.ajax.reload();
                trash.ajax.reload();
            });
        });

    }(window.jQuery, window, document));

</script>
