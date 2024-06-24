{{--Common Ajax will be here--}}
@include('scripts.theme')
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            /** present Table*/
            let presentTable = $('.present-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!!  route('reports.attendance') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-7"B><"col-md-5"f>>rtip',
                bLengthChange: false,
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_name', name: 'employee_name'},
                    {data: 'device_ip', name: 'device_ip'},
                    {data: 'attendance_date', name: 'attendance_date'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            /**absent table*/
            let absentTable = $('.absent-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!!  route('reports.attendance.absent') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: false,
                lengthMenu: ['{{config('system_settings.pagination')}}', 25, 50, 75, 100],
                pageLength: 5,
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_name', name: 'employee_name'},
                    {data: 'absent_date', name: 'absent_date'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            //Leaves-table
            let leaveTable = $('.leave-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('reports.attendance.leave') !!}',
                    data: function (d) {
                        filterData(d);
                    },
                },
                type: 'GET',
                //dom: 'Bfrtip',
                dom: '<"top"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                bLengthChange: false,
                search:false,
                lengthMenu: ['{{config('system_settings.pagination')}}', 25, 50, 75, 100],
                pageLength: {{config('system_settings.pagination')}},
                columns: [
                    {data: 'index', name: 'index', orderable: false, searchable: false},
                    {data: 'employee_name', name: 'employee_name'},
                    {data: 'type_name', name: 'type_name'},
                    {data: 'leave_days', name: 'leave_days'},
                    {data: 'details', name: 'details'},
                    {data: 'approval_status', name: 'approval_status'},
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


             $('#employee-filter').on('change', function () {
                 presentTable.ajax.reload();
                 leaveTable.ajax.reload();
                 absentTable.ajax.reload();
                 getChartData();
             });
            $('#month-filter').on('change', function () {
                presentTable.ajax.reload();
                leaveTable.ajax.reload();
                absentTable.ajax.reload();
                getChartData();
            });

        });
    }(window.jQuery, window, document));

    function filterData(d) {

        if ($('#employee-filter').length) {
            d.employee_id = $('#employee-filter').val();
        }
        if ($('#month-filter').length) {
            d.month = $('#month-filter').val();
        }
        return d;
    }


    //Get chart data via ajax
    function getChartData(){
        //Attendances Today
        if ($('#attChart').length) {
            let chartData = $.ajax({
                url:"{{route('reports.attendance.chart')}}"+'?month='+$('#month-filter').val()+'&employee_id='+$('#employee-filter').val(),
                method: "get",
                contentType: "application/json",

            }).success(function (response){
                //console.log(response)
                attChart(response);
            }).error(function (error){
                console.log(error)
            });
        }
        //end chart data
    }

    //generate Chat
    function attChart(data){
        //Chasrts
        var chartDom = document.getElementById('attChart');
        var myChart = echarts.init(chartDom, theme);
        var option;

        option = {
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: '5%',
                left: 'center'
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: { show: true, readOnly: false },
                    saveAsImage: { show: true }
                }
            },
            series: [
                {
                    name: 'Month Summery',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '40',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: data
                }
            ]
        };

        option && myChart.setOption(option);
    }
</script>
