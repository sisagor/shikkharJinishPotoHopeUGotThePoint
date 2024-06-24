<script src="{{mix('js/echarts.js')}}"></script>
@include('scripts.theme')
<script>

$(document).ready(function () {

    if (typeof (echarts) === 'undefined') { return; }

    //saalary Bar
    if ($('#salaryChart').length) {
        //Get salary data fro dashboard;
        $.ajax({
            url:"{{route('dashboard.salary')}}",
            method: "get",
            contentType: "application/json",

        }).success(function (response){
            salaryChart(response[0], response[1], response[2], response[3]);
            //test(response[0], response[1], response[2], response[3]);
        });
    }

    //Attendances average
    if ($('#attendanceAverage').length) {

        $.ajax({
            url:"{{route('dashboard.attendanceAvg')}}",
            method: "get",
            contentType: "application/json",

        }).success(function (response){
            //console.log(response)
            attendanceAverage(response[0], response[1], response[2], response[3], response[4]);
        });
    }

    //Attendances Today
    if ($('#todayAttendance').length) {
        $.ajax({
            url:"{{route('dashboard.todayAttendance')}}",
            method: "get",
            contentType: "application/json",

        }).success(function (response){
            //console.log(response)
           todayAttendance(response);
        }).error(function (error){
            console.log(error)
        });
    }

    //Leave policy
    if ($('#leavePolicy').length) {

        $.ajax({
            url:"{{route('dashboard.leavePolicy')}}",
            method: "get",
            contentType: "application/json",

        }).success(function (response){
            leavePolicy(JSON.parse(JSON.stringify(response)));
        });
    }

});


/*
* testing goese here
*
*/

/*
* testing end here
*
*/


//salary chart Bar chart
function salaryChart(level, salary, paid, due){

    var echartBar = echarts.init(document.getElementById('salaryChart'), theme);

    echartBar.setOption({
        tooltip: {},
        legend: {
            data: ['salary', 'paid', 'due']
        },
        toolbox: {
            show: true,
            feature: {
                dataView: { show: true, readOnly: false },
                magicType: { show: true, type: ['line', 'bar'] },
                restore: { show: true },
                saveAsImage: { show: true }
            }
        },
        calculable: true,
        xAxis: [{
            type: 'category',
            data: level,
            axisLine: { onZero: true },
            splitLine: { show: true },
            splitArea: { show: true }
        }],

        yAxis: [{
            type: 'value',
            splitArea: {
                show: true
            }
        }],

        series: [
            {
                name: 'salary',
                type: 'bar',
                emphasis: emphasisStyle,
                data: salary,
            },
            {
                name: 'paid',
                type: 'bar',
                emphasis: emphasisStyle,
                data: paid,
            },
            {
                name: 'due',
                type: 'bar',
                emphasis: emphasisStyle,
                data: due,
            }

        ]
    });
}

//attendance Average:
function attendanceAverage(level, present, absent, holiday, leave){

    var echartBar = echarts.init(document.getElementById('attendanceAverage'), theme);

    var emphasisStyle = {
        itemStyle: {
            shadowBlur: 20,
            shadowColor: 'rgba(0,0,0,0.3)'
        }
    };
    echartBar.setOption({
        tooltip: {},
        legend: {
            data: ['present', 'absent', 'holidays', 'leaves']
        },
        toolbox: {
            show: true,
            feature: {
                dataView: { show: true, readOnly: false },
                magicType: { show: true, type: ['line', 'bar'] },
                restore: { show: true },
                saveAsImage: { show: true }
            }
        },
        calculable: true,
        xAxis: [{
            type: 'category',
            data: level,
            axisLine: { onZero: false },
            splitLine: { show: true },
            splitArea: { show: true }
        }],

        yAxis: [{
            type: 'value',
            splitArea: {
                show: true
            }
        }],

        series: [
            {
                name: 'present',
                type: 'bar',
                emphasis: emphasisStyle,
                data: present,
            },
            {
                name: 'absent',
                type: 'bar',
                emphasis: emphasisStyle,
                data: absent,
            },
            {
                name: 'holidays',
                type: 'bar',
                emphasis: emphasisStyle,
                data: holiday,
            },
            {
                name: 'leaves',
                type: 'bar',
                emphasis: emphasisStyle,
                data: leave,
            }

        ]
    });
}

//Today attendance:
function todayAttendance(response){
    var chartDom = document.getElementById('todayAttendance');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        legend: {
            top: 'bottom'
        },
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c}'
        },
        toolbox: {
            show: true,
            feature: {
                mark: { show: true },
                dataView: { show: true, readOnly: false },
                restore: { show: true },
                saveAsImage: { show: true }
            }
        },
        series: [
            {
                name: 'Nightingale Chart',
                type: 'pie',
                radius: [30, 150],
                center: ['50%', '50%'],
                roseType: 'area',
                itemStyle: {
                    borderRadius: 10
                },
                data:response
            }
        ]
    };

    option && myChart.setOption(option);
}

//Leave Policy:
function leavePolicy(data){

    var app = {};

    var chartDom = document.getElementById('leavePolicy');
    var myChart = echarts.init(chartDom, theme);
    var option;

    option = {
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c}'
        },

        legend: {
            top: 'bottom'
        },
        toolbox: {
            show: true,
            feature: {
                mark: { show: true },
                dataView: { show: true, readOnly: false },
                restore: { show: true },
                saveAsImage: { show: true }
            }
        },
        series: {
            type: 'sunburst',
            data: data,
            radius: [0, '95%'],
            sort: undefined,
            emphasis: {
                focus: 'ancestor'
            },
            levels: [
                {},
                {
                    r0: '15%',
                    r: '35%',
                    itemStyle: {
                        borderWidth: 5
                    },
                    label: {
                        rotate: 'tangential'
                    }
                },
                {
                    r0: '35%',
                    r: '70%',
                    label: {
                        align: 'right'
                    }
                },
                {
                    r0: '70%',
                    r: '72%',
                    label: {
                        position: 'outside',
                        padding: 3,
                        silent: false
                    },
                    itemStyle: {
                        borderWidth: 5
                    }
                }
            ]
        }
    };

    option && myChart.setOption(option);

}

</script>
