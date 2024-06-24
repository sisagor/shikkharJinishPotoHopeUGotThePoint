{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

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
                    {data: 'name', name: 'name'},
                    {data: 'month', name: 'month'},
                    {data: 'basic_salary', name: 'basic_salary'},
                    {data: 'allowance', name: 'allowance'},
                    {data: 'deduction', name: 'deduction'},
                    {data: 'other_allowance', name: 'other_allowance'},
                    {data: 'other_deduction', name: 'other_deduction'},
                    {data: 'net_amount', name: 'net_amount'},
                    {data: 'paid_amount', name: 'paid_amount'},
                    {data: 'due_amount', name: 'due_amount'},
                    {data: 'is_paid', name: 'is_paid'},
                    /*{data: 'action', name: 'action', orderable: false, searchable: false},*/
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            $('#company-filter').on('change', function ()
            {
                salaryTable.ajax.reload();
            });

            $('#month-filter').on('change', function ()
            {
                salaryTable.ajax.reload();
            });

        });
    }(window.jQuery, window, document));

</script>
