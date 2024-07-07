<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            let employeeTable = $('.employee-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('employee.employees') !!}',
                    data: function (d) {
                        if ($('#company-filter').length) {
                            d.company_id = $('#company-filter').val();
                        }
                        if ($('#branch-filter').length) {
                            d.branch_id = $('#branch-filter').val();
                        }
                        if ($('#department-filter').length) {
                            d.department_id = $('#department-filter').val();
                        }
                        if ($('#designation-filter').length) {
                            d.designation_id = $('#designation-filter').val();
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
                    {data: 'department', name: 'department', searchable: false},
                    {data: 'designation', name: 'designation', searchable: false},
                    {data: 'employee_type', name: 'employee_type', searchable: false},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'device_id', name: 'device_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('#company-filter').on('change', function () {
                employeeTable.ajax.reload();
            });

            $('#branch-filter').on('change', function () {
                employeeTable.ajax.reload();
            });

            $('#department-filter').on('change', function () {
                employeeTable.ajax.reload();
            });

            $('#designation-filter').on('change', function () {
                employeeTable.ajax.reload();
            });
        });


    }(window.jQuery, window, document));

</script>
