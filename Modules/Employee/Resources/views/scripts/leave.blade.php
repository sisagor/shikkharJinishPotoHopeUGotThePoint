<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            var typeName = [];
            var days = [];

            $.ajax({
                url:'{{route('employee.getLeavePolicy')}}'+'?empId='+'{{$employee->id}}',
                method: '',
                contentType: 'application/json'
            }).success(function (response){

                if (response.length)
                {
                    for (i = 0; i < response.length; i++){
                        typeName.push(response[i].name);
                        days.push(response[i].days);
                    }
                }
                else
                {
                    typeName.push('Not found');
                    typeName.push('Not found');
                    days.push(50);
                    days.push(50);
                }
            });


            // Leave Policy chart
            if ($('#leavePolicy').length) {

                var ctx = document.getElementById("leavePolicy");
                    var data = {
                    datasets: [{
                    data: days,
                    backgroundColor: [
                    "#3498DB",
                    "#455C73",
                    "#9B59B6",
                    "#BDC3C7",
                    "#26B99A",

                    ],
                    label: 'Leave Policy' // for legend
                }],
                labels: typeName
                    };

                var pieChart = new Chart(ctx, {
                    data: data,
                    type: 'pie',
                    options: {
                        legend: false,
                        scales: {
                            xAxes: [{
                                display: false
                            }],
                            yAxes: [{
                                display: false
                            }],
                        }
                    },
                });
            }
            //End Leave Policy


            var levels = [];
            var datasets = [];

            $.ajax({
                url:'{{route('employee.getTakenLeave')}}'+'?empId='+'{{$employee->id}}',
                method: '',
                contentType: 'application/json'
            }).success(function (response){

                if (response)
                {
                    for (i = 0; i < response.data.length; i++){
                        datasets.push(response.data[i]);
                    }

                    for (i = 0; i < response.levels.length; i++){
                        levels.push(response.levels[i]);
                    }
                }
            });

            //Taken Leaves
            if ($('#takenLeaves').length) {

                var ctx = document.getElementById("takenLeaves");
                var mybarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: levels,
                        datasets: [{
                            label: '# Taken Leaves',
                            backgroundColor: "#26B99A",
                            data: datasets
                        }]
                    },

                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: false,
                    }
                });
            }
            //End Taken Leaves

        });
    }(window.jQuery, window, document));

</script>
