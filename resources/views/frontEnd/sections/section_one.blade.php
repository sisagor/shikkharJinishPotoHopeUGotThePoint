<div class="row">
    <div class="col-md-6 col-sm-6 mt-5 pl-5">
        <h6>Spark Creativity & Fun:</h6>
        <h2>Free Downloadable <br> Activity Books</h2> <br>
        <p>Welcome to our website where you can download tons of free printable activity books, coloring pages, puzzles, and more for kids and adults!</p>
        <div class="search_btn">
            <div class="input-group">
                <form class="input-group" method="get" target="_blank" action="{{route('blog.cat')}}">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary rounded-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span id="search_concept">All</span><span><img src="{{asset('/frontEnd/img/Arrow.png')}}"></span>
                        </button>
                        <div class="dropdown-menu scrollable-dropdown">
                            @foreach($categories as $key => $item)
                                <a class="dropdown-item" href="#" data>{{$item}}</a>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="search_param" value="all" id="search_param">
                    <input type="text" class="form-control rounded-3" name="search" id="search" placeholder="Template name">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary rounded-right" type="submit">Search</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="user">
            <div class="user_img">
                <img src="{{asset('/frontEnd/img/user-group.png')}}" alt="user"/>
            </div>
            <div class="user_text">
                <p>1.5+</p>
                <p>Million of Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 mt-3" style="height: 565px;">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-3">
                <div class="frame_group d-flex flex-wrap">
                    <div class="frame col-md-3">
                        <img class="frame_bg_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}" alt=""/>
                        <img class="frame_book_up" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                    </div>
                    <div class="frame col-md-3">
                        <img class="frame_bg_down_two" src="{{asset('/frontEnd/img/Rectangler69.png')}}" alt=""/>
                        <img class="frame_book_up_two" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="height: 10px;">
            <div class="col-md-12 col-sm-12 mt-3">
                <div class="frame_group d-flex flex-wrap">
                    <div class="frame col-md-3" style="margin-top: 180px;">
                        <img class="frame_bg_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}" alt=""/>
                        <img class="frame_book_up" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                    </div>
                    <div class="frame col-md-3" style="margin-top: 180px;">
                        <img class="frame_bg_down_two" src="{{asset('/frontEnd/img/Rectangler69.png')}}" alt=""/>
                        <img class="frame_book_up_two" src="{{asset('/frontEnd/img/5804202_33970.png')}}" alt="Book feature">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>