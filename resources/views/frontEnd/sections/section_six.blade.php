{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12 text-center pt-4">--}}
{{--            <div class="our-author" style="background-color: #EFEBFF;">NEW BOOK</div>--}}
{{--            <h2 class="most_pupolar_title text_color">Fresh Arrivals! Dive into Our Newest <br/> Books Now on Amazon!</h2>--}}
{{--            <p class="most_pupolar_text text_color">--}}
{{--                Unravel captivating mysteries, immerse yourself in thought-provoking non-fiction, or <br/>--}}
{{--                embark on a journey of self-discovery with inspiring guides.--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row flex-nowrap">--}}
{{--        @foreach($latestBooks as $book)--}}
{{--            <div class="col-md-3 col-sm-3 new_book_index">--}}
{{--                <img class="bg_new_index_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}"  alt="" style="max-width:95%;height:auto;"/>--}}
{{--                <a target="_blank" rel="{{$book->url_type}}" href="{{($book->url)}}">--}}
{{--                    <img class="bg_new_index_up" src="{{ get_storage_file_url(optional($book->book)->path) }}" alt="{{$book->name}}" />--}}
{{--                </a>--}}
{{--                <div class="bg_new_index_down_title text-center">--}}
{{--                    <div class="card_title">--}}
{{--                        <a target="_blank" rel="{{$book->url_type}}" href="{{($book->url)}}">--}}
{{--                            <h4 style="color: #fff">{{$book->name}}</h4>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--        --}}{{-- <div class="col-md-3 col-sm-3 new_book_index mx-4">--}}
{{--            <img class="bg_new_index_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}" alt="" style="max-width:95%;height:auto;"/>--}}
{{--            <img class="bg_new_index_up" src="{{asset('/frontEnd/img/24376429.png')}}" alt="" />--}}
{{--        </div>--}}
{{--        <div class="col-md-3 col-sm-3 new_book_index mx-4">--}}
{{--            <img class="bg_new_index_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}" alt="" style="max-width:95%;height:auto;"/>--}}
{{--            <img class="bg_new_index_up" src="{{asset('/frontEnd/img/24376429.png')}}" alt="" />--}}
{{--        </div> --}}
{{--    </div>--}}
{{--</div>--}}


<div class="container">
    <div class="row">
        <div class="col-md-12 text-center pt-4">
            <div class="our-author" style="background-color: #EFEBFF;">NEW BOOK</div>
            <h2 class="most_pupolar_title text_color">Fresh Arrivals! Dive into Our Newest <br/> Books Now on Amazon!</h2>
            <p class="most_pupolar_text text_color">
                Unravel captivating mysteries, immerse yourself in thought-provoking non-fiction, or <br/>
                embark on a journey of self-discovery with inspiring guides.
            </p>
        </div>
    </div>

    <div class="row gy-4">
        @foreach($latestBooks as $book)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 position-relative ">
                <div class="new_book_self">
                    <a target="_blank" rel="{{$book->url_type}}" href="{{($book->url)}}">
                        <img class="bg_new_index_down" src="{{asset('/frontEnd/img/Rectangle69.png')}}"  alt="" style="max-width:95%;height:auto;"/>
                    </a>
                    <div class="bg_new_book_section" >
                        <img class="bg_new_index_up" src="{{ get_storage_file_url(optional($book->book)->path) }}" alt="{{$book->name}}" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

