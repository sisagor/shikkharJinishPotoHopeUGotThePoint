<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <title>{{ config('system_settings.system_name', 'Home-Office') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/ico"/>
    <!-- Bootstrap -->
    <link href="{{mix('css/vendor.css')}}" rel="stylesheet">
    <!-- style scope -->
    @yield("styles")
    {{--custom css--}}
    <link href="{{mix('css/custom.css')}}" rel="stylesheet">

</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">

        @yield('print')
    </div>
</div>

{{--Loading --}}
<!--Modal-->
<div id="myDynamicModal" class="modal fadeInDownBig" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
     data-keyboard="false"></div>

<!-- jQuery -->
<script src="{{mix('js/vendor.js')}}"></script>

@yield('scripts')
<!-- Custom Theme Scripts -->
<script src="{{mix('js/custom.js')}}"></script>


</body>
</html>
