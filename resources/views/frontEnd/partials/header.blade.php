<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="{{asset('./frontEnd/img/Logo.png')}}" width="30" height="30" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav align-items-end">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Kids</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Audits</a>
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
        <div class="nav_right">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn  my-2 my-sm-0" type="submit"><img src="{{asset('./frontEnd/img/search-01.png')}}" alt="search"/></button>
            </form>
            <a href="#" class="sign-in-button">Sign in</a>
        </div>
    </div>
</nav>