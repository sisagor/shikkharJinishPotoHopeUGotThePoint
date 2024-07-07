{{--Common Ajax will be here--}}
@include('scripts.theme')
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

             getChartData();

             $('#employee-filter').on('change', function () {
                 getChartData();
             });

            $('#month-filter').on('change', function () {
                getChartData();
            });

        });
    }(window.jQuery, window, document));


    //Get chart data via ajax
    function getChartData(){
        //Attendances Today
        if ($('#attChart').length) {
            let chartData = $.ajax({
                url:"{{route('timesheet.dashboard.getAtt')}}"+'?month='+$('#month-filter').val()+'&employee_id='+$('#employee-filter').val(),
                method: "get",
                contentType: "application/json",

            }).success(function (response){

                response.map(function (item){
                    if(item.name == "Present"){
                        $('#presentCount').text(item.value);
                    }
                    if(item.name == "Absent"){
                        $('#absentCount').text(item.value);
                    }
                    if(item.name == "Leaves"){
                        $('#leaveCount').text(item.value);
                    }
                })

                //Call chart and pass the data;
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
