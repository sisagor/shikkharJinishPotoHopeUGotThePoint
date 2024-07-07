{{--<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {
            //Ajax get dependent dropdown
            //Check if employee create User

            let reportTable = $('.report-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('billing.bill.report') !!}',
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
                    {data: 'manager.name', name: 'manager.name'},
                    {data: 'employee.name', name: 'employee.name'},
                    {data: 'project.name', name: 'project.name'},
                    {data: 'title', name: 'title'},
                    {data: 'office_id', name: 'office_id'},
                    {data: 'site_id', name: 'site_id'},
                    {data: 'mobile_bill', name: 'other_bill'},
                    {data: 'allowance', name: 'allowance'},
                    {data: 'other_bill', name: 'other_bill'},
                    {data: 'total', name: 'total'},
                    {data: 'totalDue', name: 'totalDue'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    // Total over all pages
                   /* total = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);*/

                    // Total over this page
                    billTotal = api
                        .column(10, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    advanceTotal = api
                        .column(11, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(10).footer()).html(billTotal);
                    $(api.column(11).footer()).html(advanceTotal);
                },
            });



            $('#company-filter').on('change', function () {
                reportTable.ajax.reload();
            });
            $('#employee-filter').on('change', function () {
                reportTable.ajax.reload();
            });

        });

    }(window.jQuery, window, document));

</script>
