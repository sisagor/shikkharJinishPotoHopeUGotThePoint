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
    <link href="{{mix('css/vendor.css')}}" rel="stylesheet">
    <!-- style scope -->
    @yield("styles")
    {{--custom css--}}
    <link href="{{mix('css/custom.css')}}" rel="stylesheet">

    <script>
        window.laravel = {!! json_encode([
                'csrfToken' => csrf_token()
            ])
        !!}
    </script>
</head>

<style>

    ul > li{
        font-size: large;
    }
    .navbar-brand, .navbar-nav>li>a{
        color: black!important;
    }
    .navbar-brand, .navbar-nav>li>a{
        color: black!important;
    }

    .navbar {
        padding: 0.5rem 3rem!important;
    }

    .active{
        background: orange;
    }
    body{
        background: none!important;
    }
    .main_container {
        background: #e4e8ed!important;"
    }
     .jumbotron {
         padding: 1rem 2rem!important;
         background-color: #f3f3f3!important;
     }
</style>



<body>

<div class="container">
    <div class="main_container">
        <!-- top navigation  Header-->
        <div class="nav">
            <div class="nav_menu">
                <nav class="nav navbar-nav">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">

                        <a class="navbar-brand" href="#" >Navbar w/ text</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarText">

                            <ul class="navbar-nav mr-auto">
                              {{--  <li class="nav-item active">
                                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pricing</a>
                                </li>--}}
                            </ul>

                            <span class="navbar-text">

                              <ul class="navbar-nav mr-auto">
                                <li class="nav-item @if(request()->is('home')) active @endif">
                                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only"></span></a>
                                </li>
                                  <li class="nav-item @if(request()->segment(1) == "jobs") active @endif">
                                    <a class="nav-link" href="{{route('jobs')}}">Jobs <span class="sr-only"></span></a>
                                </li>
                                  <li class="nav-item @if(request()->is('about-us')) active @endif">
                                    <a class="nav-link" href="{{ route('about') }}">About Us <span class="sr-only"></span></a>
                                </li>
                                  <li class="nav-item @if(request()->is('contact-us')) active @endif">
                                    <a class="nav-link" href="{{route('contact')}}">Contact Us <span class="sr-only"></span></a>
                                </li>

                            </ul>
                            </span>
                        </div>
                    </nav>

                </nav>
            </div>
        </div>
        <!-- /top navigation End Header -->


        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            @include('partials.flashMessage')

            @yield('contents')
        </div>
        <!-- /page content -->


        <!-- footer content -->
        <footer style="margin-left:0px!important;">
            <div class="pull-right">
                <a target="_blank" href="{{config('app.org_url')}}"> {{trans('app.org')}} </a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>


<!-- jQuery all plugins -->
<script src="{{mix('js/vendor.js')}}"></script>

@yield('scripts')
<!-- Custom Theme Scripts -->
<script src="{{mix('js/custom.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>
