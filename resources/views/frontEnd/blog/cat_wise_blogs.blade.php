@extends('frontEnd.layouts.app')

@section('contents')

    <div class="container">
        <section>
            {{--menu section--}}
            @include('frontEnd.partials.header')
        </section>
          <section>
            <div class="breadcrumb_design">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb_item"><a href="/">Home</a></li>
                  <li class="breadcrumb_item active" aria-current="page"><a href="/blog/category">Blog</a></li>
                </ol>
              </nav>
            </div>
          </section>
          <section>
            @foreach($categories as $category)
                <div class="row descontent" id="{{ 'category_des_' . $category['id'] }}">
                    <div class="col-md-6">
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
              @foreach($categories as $category)
                  <button class="rounded_button" id="button_{{ 'category_' . $category['id'] }}" onclick="openTab(event, '{{$category['id'] }}')">{{ $category['category_name'] }}</button>
              @endforeach
          </div>
      
          @foreach($categories as $category)
              <div class="tabcontent" id="{{ 'category_' . $category['id'] }}">
                  <section>
                      <div class="row">
                          @foreach($category['blogs'] as $blog)
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
                                            Details
                                            <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                                      </a>
                                    </div>
                                </div>
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

  document.addEventListener("DOMContentLoaded", function () {
      var categoryId = "{{ $_GET['id'] ?? '' }}"; 
      if (categoryId) {
          document.getElementById('button_category_' + categoryId).click();
      } else {
          document.querySelector('.rounded_button').click();
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

</style>




@endsection