<div class="container-fluid">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset('./frontEnd/img/Logo.png')}}" width="30" height="30" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                    aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample05">
                <!-- Left side nav links -->
                <div class="navbar-left navbar-nav">
                    <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-link" href="#">Kids</a>
                    <a class="nav-link" href="#">Adults</a>
                    <a class="nav-link" href="#">Generator</a>
                    <a class="nav-link" href="#">Seasonal</a>
                    <a class="nav-link" href="{{route('blog.cat')}}">Blogs</a>
                </div>

                <!-- Right side search and sign-in -->
                <div class="navbar-right">
                    <div class="nav_search">
                        <input type="text" class="nav-search-input" placeholder="Search here">
                        <svg class="nav-search-icon" width="16" height="16" fill="currentColor"
                             viewBox="0 0 16 16">
                            <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.414-1.415l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </div>
                    <a href="#" class="sign-in-button">Sign in</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="underline"></div>
</div>
