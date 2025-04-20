@extends('frontEnd.layouts.app')

@section('contents')

        <section class="p-0">
            {{--menu section--}}
            @include('frontEnd.partials.header')
        </section>
        <div class="container">
          <section style="padding: 0">
            <div class="breadcrumb_design">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb_item"><a href="/">Home</a></li>
                  <li class="breadcrumb_item active" aria-current="page"><a href="/blog/category">Blog</a></li>
                </ol>
              </nav>
            </div>
          </section>
          <section style="padding: 0">
            @foreach($categories as $category)
                @if(isset($category['category_title']) && $category['category_title'] != '')
                    <div class="row descontent" id="category_des_all">
                        <div class="col-md-6" style="border-right: 1px solid #BBBBBC">
                            <h1>All</h1>
                        </div>
                        <div class="col-md-6">
                            <p>All Categories Show here.</p>
                        </div>
                    </div>
                    @php break; @endphp
                @endif
            @endforeach

            @foreach($categories as $category)
                <div class="row descontent" id="{{ 'category_des_' . $category['id'] }}">
                    <div class="col-md-6"  style="border-right: 1px solid #BBBBBC">
                        <h1>{{ $category['category_title'] }}</h1>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $category['category_details'] }}</p>
                    </div>
                </div>
            @endforeach
          </section>
          <section>
          <div class="tab_design">
            <button class="rounded_button" id="button_all" onclick="showAllBlogs()">All</button>
              @foreach($categories as $category)
                  <button class="rounded_button" id="button_{{ 'category_' . $category['id'] }}" onclick="openTab(event, '{{$category['id'] }}')">{{ $category['category_name'] }}</button>
              @endforeach
          </div>

         <!-- All Category Blogs  -->

         <div class="tabcontent" id="category_all">
            <section>
                <div class="row">
                    @foreach($categories as $category)
                        @foreach($category['blogs'] as $blog)
                            @php
                                //dd($blog);
                            @endphp
                            <div class="col-md-4 mb-3">
                                <a href="/blog/{{($blog['slug'])}}">
                                    <div class="card_design">
                                        <div class="card_image">
                                            <img src="{{ get_storage_file_url($blog['first_image']) }}" alt="Avatar" width="300px" height="384px">
                                        </div>
                                        <div class="author_date">
                                            <img src="{{ get_storage_file_url($blog['image']) }}" width="16px" height="16px" alt="Avatar"/>
                                            <p class="author_name">{{ $blog['created_by'] }}</p>
                                            <img src="{{ asset('/frontEnd/img/calendar.png') }}" width="16px" height="16px" alt="calendar"/>
                                            <p class="author_name">{{ date('d M, Y', strtotime($blog['created_at'])) }}</p>
                                        </div>
                                        <div class="card_title">
                                            <a href="/blog/{{ $blog['slug'] }}"><h4>{{ $blog['title'] }}</h4></a>
                                        </div>
                                        <div class="download_button">
                                            <a href="/blog/{{ $blog['slug'] }}"> Details
                                                <img src="{{ asset('/frontEnd/img/ArrowUp.png') }}" width="16px" height="16px" alt="button" />
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>
        </div>


      
          @foreach($categories as $category)
              <div class="tabcontent" id="{{ 'category_' . $category['id'] }}">
                  <section>
                      <div class="row">
                          @foreach($category['blogs'] as $blog)
                              <div class="col-md-4 mb-3">
                                  <a href="/blog/{{($blog['slug'])}}">
                                    <div class="card_design">
                                        <div class="card_image">
                                            <img src="{{get_storage_file_url($blog['first_image'])}}" alt="Avatar" width ="300px" height = "384px" >
                                        </div>
                                        <div class="author_date">
                                            <img src="{{get_storage_file_url($blog['image'])}}" width="16px" height="16px" alt="Avatar"/>
                                            <p class="author_name">{{$blog['created_by']}}</p>
                                            <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                                            <p class="author_name">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                                        </div>
                                        <div class="card_title">
                                            <a href="/blog/{{ $blog['slug'] }}"><h4>{{$blog['title']}}</h4></a>
                                        </div>
                                        <div class="download_button">
                                            <a href="/blog/{{ $blog['slug'] }}"> Details
                                                <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                                          </a>
                                        </div>
                                    </div>
                                  </a>
                              </div>
                          @endforeach
                      </div>
                  </section>
                  <section>
                      <div class="pagination">
                          <!-- Pagination links here, if needed -->
                      </div>
                  </section>
              </div>
          @endforeach
          </section>
    </div>

     <!-- tab links and tab content js  -->

  <script>
//     function openTab(evt, tabName) {
//       var tabcontent = document.getElementsByClassName("tabcontent");
//       var descontent = document.getElementsByClassName("descontent");

//       for (var i = 0; i < tabcontent.length; i++) {
//           tabcontent[i].style.display = "none";
//       }

//       for (var i = 0; i < descontent.length; i++) {
//         descontent[i].style.display = "none";
//       }

//       var tablinks = document.getElementsByClassName("rounded_button");
//       for (var i = 0; i < tablinks.length; i++) {
//           tablinks[i].classList.remove("active");
//       }

//       document.getElementById('category_' + tabName).style.display = "block";
//       document.getElementById('category_des_' + tabName).style.display = "flex";
//       evt.currentTarget.classList.add("active");
//       evt.currentTarget.focus();
//   }

//   document.addEventListener("DOMContentLoaded", function () {
//       var categoryId = "{{ $_GET['id'] ?? '' }}"; 
//       if (categoryId) {
//           document.getElementById('button_category_' + categoryId).click();
//       } else {
//           document.querySelector('.rounded_button').click();
//       }
//   });

  function openTab(evt, tabName) {
    var tabcontent = document.getElementsByClassName("tabcontent");
    var descontent = document.getElementsByClassName("descontent");

    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    for (var i = 0; i < descontent.length; i++) {
        descontent[i].style.display = "none";
    }

    var tablinks = document.getElementsByClassName("rounded_button");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    document.getElementById('category_' + tabName).style.display = "block";
    document.getElementById('category_des_' + tabName).style.display = "flex";
    evt.currentTarget.classList.add("active");
    evt.currentTarget.focus();
}

function showAllBlogs() {
    var tabcontent = document.getElementsByClassName("tabcontent");
    var descontent = document.getElementsByClassName("descontent");

    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    for (var i = 0; i < descontent.length; i++) {
        descontent[i].style.display = "none";
    }

    var tablinks = document.getElementsByClassName("rounded_button");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    document.getElementById('category_all').style.display = "block";
    document.getElementById('button_all').classList.add("active");
    document.getElementById('button_all').focus();
    document.getElementById('category_des_all').style.display = "flex";
}

document.addEventListener("DOMContentLoaded", function () {
    var categoryId = "{{ $_GET['id'] ?? '' }}"; 
    if (categoryId) {
        document.getElementById('button_category_' + categoryId).click();
    } else {
        document.getElementById('button_all').click();
    }
});

  </script>

  <style>
    .tab_design {
        text-align: center;
        margin-bottom: 20px;
    }

    .rounded_button {
        background-color: #f542c6;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 16px;
        cursor: pointer;
        margin: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .rounded_button:hover {
        background-color: #d039a8;
        transform: translateY(-3px);
    }

    .rounded_button.active {
        background-color: #d039a8;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rounded_button:focus {
        outline: none;
    }

    .tabcontent {
        display: none;
    }

    .tabcontent.active {
        display: block;
    }
    #category_all {
        display: none;
    }
   .card_title a:hover, .download_button  a:hover{
        text-decoration: none;
   }

</style>




@endsection