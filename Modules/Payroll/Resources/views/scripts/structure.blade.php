{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {
            //datatables
            let active = $('.active-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!!  route('payroll.structures').'?type=active' !!}',
                    data: function (d) {
                        if ($('#company-filter').length) {
                            d.company_id = $('#company-filter').val();
                        }
                        if ($('#branch-filter').length) {
                            d.branch_id = $('#branch-filter').val();
                        }
                    },
                    type: 'GET'
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: ['{{config('system_settings.pagination')}}', 25, 50, 75, 100],
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'type', name: 'type'},
                    {data: 'name', name: 'name'},
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
                ajax: {
                    url: '{!!  route('payroll.structures').'?type=trash' !!}',
                    data: function (d) {
                        if ($('#company-filter').length) {
                            d.company_id = $('#company-filter').val();
                        }
                        if ($('#branch-filter').length) {
                            d.branch_id = $('#branch-filter').val();
                        }
                    },
                    type: 'GET'
                },
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: true,
                lengthMenu: ['{{config('system_settings.pagination')}}', 25, 50, 75, 100],
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'type', name: 'type'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
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

            $('#branch-filter').on('change', function () {
                active.ajax.reload();
                trash.ajax.reload();
            });

        });
    }(window.jQuery, window, document));
</script>
