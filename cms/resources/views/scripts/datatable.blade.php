{{--Commmon datatable will be here--}}
<script type="text/javascript">
;(function($, window, document) {

    /**Auto Execute Part*/
    $(document).ready(function () {

        let defaultTable = $('.default-table');

        defaultTable.DataTable({
            "bPaginate": true,
            "pageLength": {{config('system_settings.pagination')}},
            //dom: 'Bfrtip',
            dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
            bLengthChange : true,
            lengthMenu : ['{{config('system_settings.pagination')}}', 25, 50, 75, 100],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

}(window.jQuery, window, document));


</script>
