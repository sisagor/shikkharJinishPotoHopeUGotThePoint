<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            let active = $('.active-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('recruitment.cms')!!}',
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
                    {data: 'type', name: 'type'},
                    {data: 'content', name: 'content'},
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
