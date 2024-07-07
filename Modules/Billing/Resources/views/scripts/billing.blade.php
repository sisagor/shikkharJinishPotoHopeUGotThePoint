{{--<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {
            //Ajax get dependent dropdown
            //Check if employee create User

            let pendingActive = $('.pending-active-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('billing.bill.pending').'?type=active'!!}',
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
                    {data: 'attachment', name: 'attachment'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            let pendingTrash = $('.pending-trash-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('billing.bill.pending').'?type=trash'!!}',
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
                    {data: 'attachment', name: 'attachment'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            //AApproved
            let approvedActive = $('.approved-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('billing.bill.approved') !!}',
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
                    {data: 'attachment', name: 'attachment'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });



            $('#company-filter').on('change', function () {
                pendingActive.ajax.reload();
                pendingTrash.ajax.reload();
                approvedActive.ajax.reload();
            });

        });

    }(window.jQuery, window, document));

</script>
