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
                    <img src="{{ asset('storage/' . ($category->image->path ?? 'frontEnd/img/BookImage.png')) }}" alt="Avatar" width ="300px" height = "384px" >
                    <div class="text-center mt-2">
                        <div class="card_title">
                            <h4>{{$category->name}}</h4>
                        </div>
                        <div class="download_button">
                            <button>
                                See Blog
                                <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
     
    </div>
</div>