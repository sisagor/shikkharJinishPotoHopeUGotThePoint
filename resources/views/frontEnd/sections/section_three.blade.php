<div class="row d-flex align-items-end">
    <div class="col-md-9">
        <p class="most_pupolar_post">MOST PUPOLAR</p>
        <h2 class="most_pupolar_title">Explore Our Most Read Blog Posts</h2>
        <p class="most_pupolar_text">
            Challenge your mind and have a blast with our most sought-after puzzles, from word searches to crosswords and brain teasers for all skill levels.
        </p>
    </div>
    <div class="col-md-3">
        {{-- <button type="button" class="btn btn-primary rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span id="search_concept">All</span><span><img src="{{asset('/frontEnd/img/Arrow.png')}}"></span>
        </button>
        <div class="dropdown-menu scrollable-dropdown">
            @foreach($categories as $key => $item)
                <a class="dropdown-item" href="#" data>{{$item}}</a>
            @endforeach
        </div> --}}
        <div class="item form-group">
            <div class="select">
                <select>
                    <option value="">All</option>
                    @foreach($categories as $key => $item)
                        <option value="{{$key}}"> {{$item}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row popular_blog">
    @foreach ($popularBlogs as $blog)
        @php
            //dd($blog);
        @endphp
        <div class="col-md-4">
            <a href="/blog/{{($blog['slug'])}}">
                <div class="card_design">
                    <a href="/blog/{{$blog['slug']}}">
                        <div class="card_image">
                            <img src="{{get_storage_file_url($blog['first_image'])}}" alt="Avatar" width ="300px" height = "384px" >
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    ;(function ($, window, document) {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#category').on('change', function() {
                var categoryId = $(this).val();
                $.ajax({
                    url: '/filter-blogs', 
                    type: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        // Update the blog list
                        $('.popular_blog').html(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

        });
      
    }(window.jQuery, window, document));

</script>