
<div class="container-fluid">
    <div class="container">
{{--        <nav class="navbar navbar-expand-md navbar-light">--}}
{{--            <a class="navbar-brand" href="{{route('home')}}">--}}
{{--                <img src="{{asset('./frontEnd/img/Logo.png')}}" width="30" height="30" alt="Logo">--}}
{{--            </a>--}}
{{--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
{{--            <div class="collapse navbar-collapse" id="navbarNav">--}}
{{--                <ul class="navbar-nav align-items-end">--}}
{{--                    <li class="nav-item active">--}}
{{--                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">Kids</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">Adults</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">Generator</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#">Seasonal</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{route('blog.cat')}}">Blogs</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <div class="nav_right">--}}
{{--                    <form class="form-inline my-2 my-lg-0 position-relative" method="get" target="_blank" action="{{route('blog.search')}}">--}}
{{--                        <input type="hidden" class="cat" name="cat" value="all">--}}
{{--                        <input class="form-control" name="title" type="text" placeholder="Search" aria-label="Search">--}}
{{--                        <button class="btn s_btn my-2 my-sm-0" type="submit">--}}
{{--                            <img src="{{asset('./frontEnd/img/search-01.png')}}" alt="search" />--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <a href="#" class="sign-in-button ml-2">Sign in</a>--}}
{{--            </div>--}}
{{--        </nav>--}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset('./frontEnd/img/Logo.png')}}" width="30" height="30" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kids</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Adults</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Generator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Seasonal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blog.cat')}}">Blogs</a>
                    </li>
                </ul>
                <form class=" my-2 my-lg-0 position-relative" method="get" target="_blank" action="{{route('blog.search')}}">

                    <div class="nav_right">
                        <div class="nav_search">
                            <input type="text" class="search-input" placeholder="Search here">
                            <svg class="search-icon" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.414-1.415l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                            </svg>
                        </div>
                        <div class="my-2">
                            <a href="#" class="sign-in-button ml-2">Sign in</a>
                        </div>

                    </div>
                </form>
            </div>
        </nav>
    </div>
    <div class="underline"></div>
</div>

