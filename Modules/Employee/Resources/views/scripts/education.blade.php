<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            let employeeTable = $('.education-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('employee.educations', $employee->id) !!}',
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: false,
                lengthMenu: ['{{config('system_settings.pagination')}}', 25, 50, 75, 100],
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'exam_title', name: 'exam_title'},
                    {data: 'institute', name: 'institute'},
                    {data: 'passing_year', name: 'passing_year'},
                    {data: 'cgpa', name: 'cgpa'},
                    {data: 'out_of', name: 'out_of'},
                    {data: 'approval_status', name: 'approval_status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });


    }(window.jQuery, window, document));

</script>
