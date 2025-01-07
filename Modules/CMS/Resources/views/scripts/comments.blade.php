<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            let active = $('.active-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('cms.comments').'?type=active'!!}',
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
                    {data: 'blog.title', name: 'blog'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'parent_comment', name: 'parent_comment'},
                    {data: 'comment', name: 'comment'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            let trash = $('.trash-table').DataTable({
               
            });

            $('#company-filter').on('change', function () {
                active.ajax.reload();
                trash.ajax.reload();
            });
        });


    }(window.jQuery, window, document));

</script>
