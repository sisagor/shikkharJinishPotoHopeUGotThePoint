<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="our-author" style="background-color: #EFEBFF;">POPULAR BLOG CATEGORIES</div>
            <h2 class="most_pupolar_title">Get Organized & Inspired: Your Guide to Planners & Calendars</h2>
            <p class="most_pupolar_text">
                Planning your life never looked so good! Dive into our collection of insightful blog posts dedicated
                to all things planners and calendars. Whether you're a productivity pro or just starting out
            </p>
        </div>
    </div>
    <div class="row"> 
        @foreach($topCategories as $key => $category)
            <div class="col-md-4">
                <div class="card_design">
                    @if($category->image)
                        <img src="{{ get_storage_file_url($category->image->path) }}" alt="Avatar" width ="300px" height = "384px" >
                    @else
                        <img src="{{ asset('frontEnd/img/BookImage.png') }}" alt="Avatar" width ="300px" height = "384px" >
                    @endif
                    <div class="text-center mt-2">
                        <div class="card_title">
                            <h4>{{$category->name}}</h4>
                        </div>
                        <div class="download_button">
                            <a href="/blog/category?id={{$category['id']}}">
                                See Blog
                                <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
     
    </div>
</div>
<style>
    .download_button a {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        color: #F01E76;
        text-align: center;
        font-family: Rubik;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
    }
    .download_button a:hover {
       text-decoration: none;
    }
</style>