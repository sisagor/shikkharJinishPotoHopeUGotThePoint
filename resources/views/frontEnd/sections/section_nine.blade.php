<div class="container subscribe_parant">
    <div class="subscribe_bg">
        <img src="{{asset('/frontEnd/img/HeaderSubscribeBG.png')}}" alt="" class="center_image"/>
    </div>
    <div class="subscribe_container">
        <div class="sub_subscribe_container" style="margin-top: 30px; position: relative; display: inline-block;">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <h1>Subscribe for Daily Blog</h1>
            <p>An awesome discount awaits for you</p>
            <div style="position: relative; display: inline-block; width: 100%;">
                <input type="email" placeholder="Type your email" id="email-input">
                <img src="{{asset('/frontEnd/img/Sent-icon.png')}}" alt="Send" id="email-submit-button">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    ;(function ($, window, document) {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#email-submit-button').click(function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var email = $('#email-input').val();
                if(emailRegex.test(email)){
                    $.ajax({
                        url: '/email_subscription',
                        type: 'POST',
                        data: {
                            email: email
                        },
                        success: function(response) {
                            // Handle successful response
                            alert('Email submitted successfully!');
                            $('#email-input').val('');
                        },
                        error: function(error) {
                            // Handle error
                            // console.log(error.responseJSON);
                            alert(error.responseJSON.message);
                            $('#email-input').val('');
                        }
                    });

            }else{
                alert('Please enter a valid email address.');
            }

            });

        });
      
    }(window.jQuery, window, document));

</script>