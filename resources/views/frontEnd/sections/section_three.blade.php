<div class="row">
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
            <select class="btn btn-primary rounded" name="category" id="category">
                <option value="">All</option>
                @foreach($categories as $key => $item)
                    <option value="{{$key}}"> {{$item}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row popular_blog">
    @foreach ($popularBlogs as $blog)
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
                    <h4>{{$blog['title']}}</h4>
                </div>
                <div class="download_button">
                    <a href="/blog/{{$blog['id']}}">
                        Read More
                        <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                    </a>
                </div>
            </div>
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