<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="our-author" style="background-color: #EFEBFF;">LATEST BLOG</div>
            <h2 class="most_pupolar_title">The Magic of Coloring: Unwinding, Learning, and Having Fun!</h2>
            <p class="most_pupolar_text">
                Dive into the diverse world of coloring books! From playful themes for kids to intricate designs for adults, discover the perfect coloring book to match your age, interests, and artistic desires.
            </p>
        </div>
    </div>
    <div class="row">
        @foreach ($latestBlogs as $blog)
            <div class="col-md-4">
                <div class="card_design">
                    <img src="{{get_storage_file_url($blog['first_image'])}}" alt="Avatar" width ="300px" height = "384px" >
                    <div class="author_date">
                        <img src="{{get_storage_file_url($blog['image'])}}" width="16px" height="16px" alt="Avatar"/>
                        <p class="author_name">{{$blog['created_by']}}</p>
                        <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                        <p class="author_name">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                    </div>
                    <div class="card_title">
                        <a rel="{{$blog['url_type']}}" href="/{{ $blog['slug'] }}">
                            <h4>{{ $blog['title'] }}</h4>
                        </a>
                    </div>
                    <div class="download_button">
                        <a rel="{{$blog['url_type']}}" href="/{{ $blog['slug'] }}">
                            Details
                            <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>