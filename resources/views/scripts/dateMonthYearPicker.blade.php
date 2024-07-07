<link rel="stylesheet" href="{{asset('css/timepicker.min.css')}}">
<script src="{{asset('js/timepicker.min.js')}}"></script>

<script type="text/javascript">
    ;(function ($, window, document, jQuery) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            $(".timePicker").timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                startTime: '12:00 am',
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                zindex: 9999999,
            });

            $("#myDatepicker").datetimepicker({
                format: 'YYYY-MM-DD',
            });

            $(".datePicker").datetimepicker({
                format: 'YYYY-MM-DD',
            });

            // *** (month and year only) ***
            $(function () {
                $('.monthYearPicker').datepicker({
                    yearRange: "c-100:c",
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    closeText: 'Select',
                    currentText: 'This year',
                    onClose: function (dateText, inst) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).val($.datepicker.formatDate('MM yy (M y) (mm/y)', new Date(year, month, 1)));
                    }
                }).focus(function () {
                    $(".ui-datepicker-calendar").hide();
                    $(".ui-datepicker-current").hide();
                    $("#ui-datepicker-div").position({
                        my: "left top",
                        at: "left bottom",
                        of: $(this)
                    });
                }).attr("readonly", false);
            });
            // --------------------------------


            // *** (year only) ***
            $(function () {
                $('.yearPicker').datepicker({
                    yearRange: "c-100:c",
                    changeMonth: false,
                    changeYear: true,
                    showButtonPanel: true,
                    closeText: 'Select',
                    currentText: 'This year',
                    onClose: function (dateText, inst) {
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).val($.datepicker.formatDate('yy', new Date(year, 1, 1)));
                    }
                }).focus(function () {
                    $(".ui-datepicker-month").hide();
                    $(".ui-datepicker-calendar").hide();
                    $(".ui-datepicker-current").hide();
                    $(".ui-datepicker-prev").hide();
                    $(".ui-datepicker-next").hide();
                    $("#ui-datepicker-div").position({
                        my: "left top",
                        at: "left bottom",
                        of: $(this)
                    });
                }).attr("readonly", false);
            });
            // --------------------------------


            // *** (year only, no controls) ***
            $(function () {
                $('#yearPicker2').datepicker({
                    dateFormat: "yy",
                    yearRange: "c-100:c",
                    changeMonth: false,
                    changeYear: true,
                    showButtonPanel: false,
                    closeText: 'Select',
                    currentText: 'This year',
                    onClose: function (dateText, inst) {
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).val($.datepicker.formatDate('yy', new Date(year, 1, 1)));
                    },
                    onChangeMonthYear: function () {
                        $(this).datepicker("hide");
                    }
                }).focus(function () {
                    $(".ui-datepicker-month").hide();
                    $(".ui-datepicker-calendar").hide();
                    $(".ui-datepicker-current").hide();
                    $(".ui-datepicker-prev").hide();
                    $(".ui-datepicker-next").hide();
                    $("#ui-datepicker-div").position({
                        my: "left top",
                        at: "left bottom",
                        of: $(this)
                    });
                }).attr("readonly", false);
            });
            // --------------------------------


        });


    }(window.jQuery, window, document));

</script>
