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
                  <li class="breadcrumb_item"><a href="#">Home</a></li>
                  <li class="breadcrumb_item"><a href="#">Blog</a></li>
                  <li class="breadcrumb_item active" aria-current="page">Current Page</li>
                </ol>
              </nav>
            </div>
          </section>
          <section>
            <div class="row">
              <div class="col-md-6">
                <h1>Spark the Fun: Your One-Stop Shop for Engaging Kids' Activities!</h1>
              </div>
              <div class="col-md-6">
                <p>Our worksheet generator helps you make puzzles and printables that are educational, personal, and fun!
                  Perfect for classrooms, these make-your-own word searches, crosswords, scrambles, and matching lists are an
                  excellent tool for reviewing key subjects and skills. Each printable created through our reading and math
                  worksheet generator is fully customizable, with a selection of colorful borders and a title that is unique
                  to you.</p>
              </div>
            </div>
          </section>
          <section>
          <div class="tab_design">
              @foreach($categories as $category)
                  <button class="rounded_button" onclick="openTab(event, '{{ 'category_' . $category['id'] }}')">{{ $category['category_name'] }}</button>
              @endforeach
          </div>
      
          @foreach($categories as $category)
              <div class="tabcontent" id="{{ 'category_' . $category['id'] }}">
                  <section>
                      <div class="row">
                          @foreach($category['blogs'] as $blog)
                              <div class="col-md-4">
                                <div class="card_design">
                                    <img src="{{asset('storage/'.$blog['first_image'])}}" alt="Avatar" width ="300px" height = "384px" >
                                    <div class="author_date">
                                        <img src="{{asset('storage/'.$blog['image'])}}" width="16px" height="16px" alt="Avatar"/>
                                        <p class="author_name">{{$blog['created_by']}}</p>
                                        <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                                        <p class="author_name">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                                    </div>
                                    <div class="card_title">
                                        <h4>{{$blog['title']}}</h4>
                                    </div>
                                    <div class="download_button">
                                        <button>
                                            Details
                                            <img src="{{asset('/frontEnd/img/ArrowUp.png')}}" width="16px" height="16px" alt="button" />
                                        </button>
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
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    var tablinks = document.getElementsByClassName("rounded_button");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
    evt.currentTarget.focus();
    }

    document.addEventListener("DOMContentLoaded", function () {
      document.querySelector('.rounded_button').click();
    });
  </script>


@endsection