<div class="row">
    <div class="col-md-9">
        <p class="most_pupolar_post">MOST PUPOLAR</p>
        <h2 class="most_pupolar_title">Explore Our Most Read Blog Posts</h2>
        <p class="most_pupolar_text">
            Challenge your mind and have a blast with our most sought-after puzzles, from word searches to crosswords and brain teasers for all skill levels.
        </p>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span id="search_concept">All</span><span><img src="{{asset('/frontEnd/img/Arrow.png')}}"></span>
        </button>
        <div class="dropdown-menu scrollable-dropdown">
            @foreach($categories as $key => $item)
                <a class="dropdown-item" href="#" data>{{$item}}</a>
            @endforeach
        </div>
    </div>
</div>
<div class="row">
    @foreach ($blogs as $blog)
        <div class="col-md-4">
            <div class="card_design">
                <img src="{{asset('storage/'.$blog['first_image'])}}" alt="Avatar" width ="300px" height = "384px" >
                <div class="author_date">
                    <img src="{{asset('/frontEnd/img/user.png')}}" width="16px" height="16px" alt="Avatar"/>
                    <p class="author_name">{{$blog['created_by']}}</p>
                    <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                    <p class="author_name">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                </div>
                <div class="card_title">
                    <h4>{{$blog['title']}}</h4>
                </div>
                <div class="download_button">
                    <button>
                        Read More
                        <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                    </button>
                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="col-md-4">
        <div class="card_design">
            <img src="{{asset('/frontEnd/img/BookImage.png')}}" alt="Avatar" width ="300px" height = "384px" >
            <div class="author_date">
                <img src="{{asset('/frontEnd/img/user.png')}}" width="16px" height="16px" alt="Avatar"/>
                <p class="author_name">Rasel Mondol</p>
                <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                <p class="author_name">09 Feb, 2024</p>
            </div>
            <div class="card_title">
                <h4>Unwind and Learn: Top Coloring Pages for Kids</h4>
            </div>
            <div class="download_button">
                <button>
                    Download
                    <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card_design">
            <img src="{{asset('/frontEnd/img/Book_Images.png')}}" alt="Avatar" width ="300px" height = "384px" >
            <div class="author_date">
                <img src="{{asset('/frontEnd/img/user.png')}}" width="16px" height="16px" alt="Avatar"/>
                <p class="author_name">Rasel Mondol</p>
                <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                <p class="author_name">09 Feb, 2024</p>
            </div>
            <div class="card_title">
                <h4>Unwind and Learn: Top Coloring Pages for Kids</h4>
            </div>
            <div class="download_button">
                <button>
                    Download
                    <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card_design">
            <img src="{{asset('/frontEnd/img/Book_Image.png')}}" alt="Avatar" width ="300px" height = "384px" >
            <div class="author_date">
                <img src="{{asset('/frontEnd/img/user.png')}}" width="16px" height="16px" alt="Avatar"/>
                <p class="author_name">Rasel Mondol</p>
                <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                <p class="author_name">09 Feb, 2024</p>
            </div>
            <div class="card_title">
                <h4>Unwind and Learn: Top Coloring Pages for Kids</h4>
            </div>
            <div class="download_button">
                <button>
                    Download
                    <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                </button>
            </div>
        </div>
    </div> --}}
</div>