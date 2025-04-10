

<div class="row">
    <div class="col-md-6 col-sm-6 mt-5 pl-5 feature_free_header">
        <h5>Spark Creativity & Fun:</h5>
        <h1>Free Downloadable <br> Activity Books</h1> <br>
        <p>Welcome to our website where you can download tons of free printable activity books, coloring
            pages, puzzles, and more for kids and adults!</p>
        <form method="get" target="_blank" action="{{route('blog.search')}}">
            <div class="container_btn">

                <div class="select-wrapper">
                    <select name="cat" id="cat" class="left_select">
                        <option value="all">All</option>
                        @foreach($categories as $key => $cat)
                            <option value="{{$key}}">{{$cat}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="vertical-line"></div>
                <svg class="search-icon" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.414-1.415l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>
                <input type="text" class="template_name" name="title" id="title" placeholder="Title">
                <button type="submit" id="search_submit" class="right_btn">Search</button>
            </div>
        </form>

        <div class="user">
            <div class="user_img">
                <img src="{{asset('/frontEnd/img/user-group.png')}}" alt="user" />
            </div>
            <div class="user_text">
                <h6>1.5+</h6>
                <p>Million of Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-5">
                <div class="frame_group d-flex flex-wrap justify-content-between">
                    @foreach($popularBook as $key => $book)
                        @if($key < 2)
                            @if($key == 0)
                                <div class="frame col-md-5">
                                    <img class="frame_bg_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}" alt="" />
                                    <a target="_blank" rel="{{$book->url_type}}" href="{{($book->url)}}">
                                        <img class="frame_book_up" src="{{ get_storage_file_url(optional($book->book)->path) }}" alt="">
                                    </a>
                                </div>
                            @else
                                <div class="frame col-md-6">
                                    <img class="frame_bg_down_two" src="{{asset('/frontEnd/img/Rectangler69.png')}}" alt="" />
                                    <a target="_blank" rel="{{$book->url_type}}" href="{{($book->url)}}">
                                    <img class="frame_book_up_two" src="{{ get_storage_file_url(optional($book->book)->path) }}" alt="">
                                    </a>
                                </div>
                            @endif
                        @endif
                      {{--  <div class="frame col-md-6">
                            <img class="frame_bg_down_two" src="{{asset('/frontEnd/img/Rectangler69.png')}}" alt="" />
                            <img class="frame_book_up_two" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                        </div>--}}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-3">
                <div class="frame_group d-flex flex-wrap justify-content-between">

                    @foreach($popularBook as $key => $book)
                        @if($key > 1)
                            @if($key == 2)
                                <div class="frame col-md-5">
                                    <img class="frame_bg_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}" alt="" />
                                    <a target="_blank" rel="{{$book->url_type}}" href="{{($book->url)}}">
                                        <img class="frame_book_up" src="{{ get_storage_file_url(optional($book->book)->path) }}" alt="">
                                    </a>
                                </div>
                            @else
                                <div class="frame col-md-6">
                                    <img class="frame_bg_down_two" src="{{asset('/frontEnd/img/Rectangler69.png')}}" alt="" />
                                    <a target="_blank" rel="{{$book->url_type}}" href="{{($book->url)}}">
                                        <img class="frame_book_up_two" src="{{ get_storage_file_url(optional($book->book)->path) }}" alt="">
                                    </a>
                                </div>
                            @endif
                        @endif
                        {{--  <div class="frame col-md-6">
                              <img class="frame_bg_down_two" src="{{asset('/frontEnd/img/Rectangler69.png')}}" alt="" />
                              <img class="frame_book_up_two" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                          </div>--}}
                    @endforeach
                  {{--  <div class="frame col-md-5">
                        <img class="frame_bg_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}" alt="" />
                        <img class="frame_book_up" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                    </div>
                    <div class="frame col-md-6">
                        <img class="frame_bg_down_two" src="{{asset('/frontEnd/img/Rectangler69.png')}}" alt="" />
                        <img class="frame_book_up_two" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>