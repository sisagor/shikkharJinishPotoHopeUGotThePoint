<script type="text/javascript">
    ;(function ($, window, document) {

        $(".ajax-modal-btn").hide(); // hide the ajax functional button untill the page load completely
        /**Auto Execute Part*/
        $(document).ready(function () {
            /**Ajax modal button*/
            $('.ajax-modal-btn').removeAttr('href').css('cursor', 'pointer').show();

            remove_busy_filter();
            // Support for AJAX loaded modal window.
            $('body').on('click', '.ajax-modal-btn', function (e) {
                e.preventDefault();

                //Apply bubsy filter
                apply_busy_filter();

                var url = $(this).data('link');

                if (url.indexOf('#') == 0) {
                    $(url).modal('open');
                } else {
                    $.get(url, function (data) {

                        remove_busy_filter();

                        //Load modal data
                        $('#myDynamicModal').modal().html(data);

                        //Initialize application plugins after ajax load the content
                        /* if (typeof initAppPlugins == 'function') {
                             initAppPlugins();
                         }*/
                    })
                        .done(function () {
                            $('.modal-body input:text:visible:first').focus();
                        })
                        .fail(function (response) {
                            if (401 === response.status) {
                                window.location = '{{ route('login') }}';
                            } else {
                                console.log('{{ trans('responses.error') }}');
                            }
                        });
                }
            });

            $(document).on('hidden.bs.modal', '.modal', function () {
                $('.modal:visible').length && $(document.body).addClass('modal-open');
            });

            $('.modal-dismiss').click(function (event) {
                $('.note-modal').modal('hide');
            });

            /** auto remove falsh message*/
            setTimeout(function () {
                $('.alert-dismissible').remove();
            }, 8000);

            //Basic Select2
            $(".select2-dropdown").select2();


            $("#parent_id").on('change', function () {

                let childId = $('#parent_id').data('child-id');
                let link = $('#parent_id').data('link');
                $('#' + childId).empty();

                $.ajax({
                    url: link + '?id=' + $(this).val(),
                    contentType: 'application/json',
                    method: 'get',
                    success: function (data) {
                        if (Array.isArray(data)) {
                            for (i = 0; i < data.length; i++) {
                                $('#' + childId).append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
                            }
                        } else {
                            $('#' + childId).append('<option value="' + data.id + '">' + data.text + '</option>');
                        }
                    },
                });
            });

        });

    }(window.jQuery, window, document));

    /**Apply Busy filter*/
    function apply_busy_filter(dom = 'body') {
        //Disable mouse pointer events and set the busy filter
        jQuery(dom).css("pointer-events", "none");
        jQuery('.loader').show();
        jQuery("body > *:not(.loader)").css('filter', 'blur(15px)');
    }

    /**remove busy filter*/
    function remove_busy_filter(dom = 'body') {
        //Enable mouse pointer events and remove the busy filter
        jQuery(dom).css("pointer-events", "auto");
        //jQuery(".nav-md").removeClass('blur-filter');
        jQuery("body > *:not(.loader)").css('filter', 'blur(0px)');
        jQuery('.loader').hide();
    }

    /** check all modules Items*/
    function selectActions(str) {
        let selector = $('#' + str);
        //selector.children().children(':checkbox').prop('checked', $(this).prop("checked"));
        selector.children().children(':checkbox').each(function (index, item) {

            //console.log($('#' + str).is(':checked'));
            /* let menuId = $('#' + item.id);*/

            if (item.checked) {
                item.checked = false;
            } else if (!item.checked) {
                item.checked = true;
            }

            /*if (item.checked) {
                item.checked = false;
            }*/
        });
    }


    /** Mark as read and count and remove notification*/
    function markAsRead(item, removeItem = null) {

        let unreadClass = 'unread-notification-back';
        let pointClass = 'mark-as-read-' + item;
        let shouldRemoveItem = 'remove-item-' + item;
        let routeUrl = '{{route('markAsRead')}}';
        let notiCount = parseInt($('.notificationCount').text());

        $.ajax({
            url: routeUrl + '?id=' + item,
            contentType: "application/json",
            method: "get"
        }).success(function (response) {

            if (response.status == 1) {

                $('.' + pointClass).removeClass(unreadClass);

                @include('scripts.notification',
                    [
                        'title' => trans('msg.mark_as_read'),
                        'msg' => trans('msg.notification_marked_as_read'),
                        'type' => 'success',
                    ])

                {{--Remove itam--}}
                $('.' + shouldRemoveItem).remove();
                {{--Item count --}}
                $('.notificationCount').text(notiCount - 1);
                $('.mark_as_read_button_' + item).removeClass('show');
                $('.mark_as_read_button_' + item).addClass('hide');
                $('.marked_as_read_button_' + item).removeClass('hide');
                $('.marked_as_read_button_' + item).addClass('show');
            }
        })
    }


    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    }

    /**All filter are comes from here*/
    function filterData(d) {

        if ($('#company-filter').length) {
            d.com_id = $('#company-filter').val();
        }

        if ($('#department-filter').length) {
            d.department_id = $('#department-filter').val();
        }

        if ( $('#designation-filter').length) {
            d.designation_id = $('#designation-filter').val();
        }

        if ($('#employee-filter').length) {
            d.employee_id = $('#employee-filter').val();
        }
        if ($('#month-filter').length) {
            d.month = $('#month-filter').val();
        }

        if ($("#from-date-filter")){
            d.from_date = $("#from-date-filter").val();
        }

        if ($("#to-date-filter")){
            d.to_date = $("#to-date-filter").val();
        }
        if ($("#status-filter")){
            d.status = $("#status-filter").val();
        }
        return d;
    }

    function paginationLengthMenu(){
        return [
            '{{config('system_settings.pagination')}}',
            '{{config('system_settings.pagination') * 2}}',
            '{{config('system_settings.pagination') * 3}}',
            '{{config('system_settings.pagination') * 4}}',
            '{{config('system_settings.pagination') * 5}}'
        ];
    }

    function ReportPaginationLengthMenu(){
        return [
            '{{config('system_settings.report_pagination')}}',
            '{{config('system_settings.report_pagination') * 2}}',
            '{{config('system_settings.report_pagination') * 3}}',
            '{{config('system_settings.report_pagination') * 4}}',
            '{{config('system_settings.report_pagination') * 5}}'
        ];
    }


    function showNotification(type, msg){

        $('.showNotification').html(
            '<div class="w-100 alert alert-' + type + ' alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">×</span>' +
                '</button>'+
                '<strong>Notice! </strong> &nbsp; '+ msg +
            '</div>'
        )
    }

</script>
