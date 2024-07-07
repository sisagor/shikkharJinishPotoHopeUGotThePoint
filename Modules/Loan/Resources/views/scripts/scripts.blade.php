<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            let active = $('.pending-loan-active-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('loans.loan.pending').'?type=active'!!}',
                    type: 'GET',
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
                    {data: 'employee.employee_index', name: 'employee.employee_index'},
                    {data: 'employee.name', name: 'employee.name'},
                    {data: 'type', name: 'type'},
                    {data: 'interest_percent', name: 'interest_percent'},
                    {data: 'loan_amount', name: 'loan_amount'},
                    {data: 'installments', name: 'installments'},
                    {data: 'installment_amount', name: 'installment_amount'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            let trash = $('.pending-loan-trash-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('loans.loan.pending').'?type=trash'!!}',
                    type: 'GET',
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
                    {data: 'employee.employee_index', name: 'employee.employee_index'},
                    {data: 'employee.name', name: 'employee.name'},
                    {data: 'type', name: 'type'},
                    {data: 'interest_percent', name: 'interest_percent'},
                    {data: 'loan_amount', name: 'loan_amount'},
                    {data: 'installments', name: 'installments'},
                    {data: 'installment_amount', name: 'installment_amount'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $('#company-filter').on('change', function () {
                active.ajax.reload();
                trash.ajax.reload();
            });
        });


    }(window.jQuery, window, document));

</script>
