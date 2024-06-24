<script type="text/javascript">
    /**Auto Execute Part*/
    $(document).ready(function () {

        let notiCount = parseInt($('.notificationCount').text());
        //console.log("working here");
        //window.Pusher.logToConsole = true;
        window.Echo.private(`user-{{auth()->id()}}`)
            .notification((data) => {
                //let id = data.id;
                let notification = '<li class="nav-item remove-item-' + data.id + ' pos-f-t">' +
                    '<a class= "dropdown-item unread-notification-back" onclick="markAsRead(' + data.id + ', 1)">' +
                    '<span> ' + data.name + ' </span>' +
                    '<span class="time"> ' + data.date + '</span>' +
                    '<span class="message">' + data.activity + '</span>' +
                    '</a></li>';

                $('#position-top').append(notification);
                $('.notificationCount').text(notiCount + 1);
            });
    });
</script>
