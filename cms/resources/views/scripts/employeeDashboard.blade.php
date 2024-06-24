<script type="text/javascript">

$(document).ready(function () {

    init_calendar();

    getChartData();

});

    //Get chart data via ajax
    function getChartData(){
    //Attendances Today
        let chartData = $.ajax({
            url:"{{route('timesheet.dashboard.getAtt')}}"+'?month={{\Carbon\Carbon::now()->format('Y-m')}}&employee_id={{auth()->user()->employee_id}}',
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

        }).error(function (error){
            console.log(error)
        });
    //end chart data
    }

    /* CALENDAR */
    function init_calendar() {

        if (typeof ($.fn.fullCalendar) === 'undefined') { return; }
        //console.log('init_calendar');

        var date = new Date(),
            d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
            started,
            categoryClass;

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek'
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                $('#fc_create').click();

                started = start;
                ended = end;

                $(".antosubmit").on("click", function () {
                    var title = $("#title").val();
                    if (end) {
                        ended = end;
                    }

                    categoryClass = $("#event_type").val();

                    if (title) {
                        calendar.fullCalendar('renderEvent', {
                                title: title,
                                start: started,
                                end: end,
                                allDay: allDay
                            },
                            true // make the event "stick"
                        );
                    }

                    $('#title').val('');

                    calendar.fullCalendar('unselect');

                    $('.antoclose').click();

                    return false;
                });
            },
            eventClick: function (calEvent, jsEvent, view) {
                $('#fc_edit').click();
                $('#title2').val(view);

                categoryClass = $("#event_type").val();

                $(".antosubmit2").on("click", function () {
                    calEvent.title = $("#title2").val();

                    calendar.fullCalendar('updateEvent', calEvent);
                    $('.antoclose2').click();
                });

                calendar.fullCalendar('unselect');
            },
            editable: false,
            events: {
                url: '{{route('dashboard.holidays')}}',
            },
        });

        //console.log(data)

    }

</script>
