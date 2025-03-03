@foreach ($blogs as $blog)
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