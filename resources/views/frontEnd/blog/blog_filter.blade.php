@foreach ($popularBlogs as $blog)
    @php
        //dd($blog);
    @endphp
    <div class="col-md-4">
        <a href="/blog/{{($blog['slug'])}}">
            <div class="card_design">
                <a href="/blog/{{$blog['slug']}}">
                    <div class="card_image">
                        <img src="{{get_storage_file_url($blog['first_image'])}}" alt="Avatar" >
                    </div>
                </a>
                <div class="author_date">
                    <div class="sub_author">
                        <img src="{{get_storage_file_url($blog['image'])}}" width="16px" height="16px" alt="Avatar"/>
                        <p class="author_name">{{$blog['created_by']}}</p>
                    </div>
                    <div class="sub_author">
                        <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                        <p class="author_name">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                    </div>
                </div>
                <div class="card_title">
                    <a rel="{{$blog['url_type']}}" href="/blog/{{($blog['slug'])}}">
                        <h4>{{$blog['title']}}</h4>
                    </a>
                </div>
                <div class="download_button">
                    <a href="/blog/{{$blog['slug']}}">
                        Read More
                        <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                    </a>
                </div>
            </div>
        </a>
    </div>
@endforeach