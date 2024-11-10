<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <title>{{ config('system_settings.system_name', 'inta-hrm') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/ico"/>
    <!-- Bootstrap -->
    <link href="{{mix('css/vendor.css')}}" rel="stylesheet" type="text/css" {{--media="wait" onload="if(media!='all')media='all'"--}}>
    <!-- style scope -->
    @yield("styles")
    {{--custom css--}}
    <link href="{{mix('css/custom.css')}}" rel="stylesheet" type="text/css" media="wait" onload="if(media!='all')media='all'">

    
    <script>
        window.laravel = {!! json_encode([
                'csrfToken' => csrf_token()
            ])
        !!}
    </script>
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            @if(! is_employee())
                @include('partials.menu.left_menu')
            @else
                @include('partials.menu.left_menu_employee')
            @endif
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            @include('partials.header')
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            @include('partials.flashMessage')

            @yield('contents')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            @include('partials.footer')
        </footer>
        <!-- /footer content -->
    </div>

</div>

{{--Loading --}}
<div class="loader">
    <center>
        <img class="loading-image" src="{{ asset('images/load.gif') }}" alt="busy...">
    </center>
</div>

<!--Modal-->
<div id="myDynamicModal" class="modal fadeInDownBig" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
     data-keyboard="false"></div>

<!-- jQuery all plugins -->
<script src="{{mix('js/vendor.js')}}"></script>

{{--Pusher assets--}}
@if (config('system_settings.system_realtime_notification'))

    <script src="{{mix('js/app.js')}}"></script>
    <script>
        var socketId = Echo.socketId();
    </script>

    @include('scripts.pusher')
@endif

@yield('scripts')
<!-- Custom Theme Scripts -->
<script src="{{mix('js/custom.js')}}"></script>

{{--Custome js--}}
@include('scripts.apps')
@include('scripts.ajax')
@include('scripts.dateMonthYearPicker')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>
