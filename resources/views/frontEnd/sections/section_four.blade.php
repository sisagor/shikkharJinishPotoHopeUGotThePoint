<section class="testimonials bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <div class="our-author" style="background-color: #EFEBFF;">OUR TEAM</div>
                <h2 class="most_pupolar_title" style="color: #FFFFFF;">Meet Our Amazing Team</h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div id="customers-testimonials" class="owl-carousel">
                    <!-- Testimonial 1 -->
                    @foreach($authors as $author)
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="{{get_storage_file_url($author->profile->image->path)}}" alt="">
                            </div>
                            <div class="testimonial-name">
                                <h2>{{$author->name}}</h2>
                                <div>
                                    <div class="profession">
                                        <p>{{$author->profile->occupation}}</p>
                                        <div class="right_column">
                                            <a @if($author->profile->facebook) target="_blank" @endif href="@if($author->profile->facebook){{$author->profile->facebook}}@else#@endif" style="width: 16px;height: 16px" class="social_icon ">
                                                <img src="{{asset('/frontEnd/img/logos_facebook-icon.png')}}" alt="facebook icon"/>
                                            </a>
                                            <a  @if($author->profile->twitter) target="_blank" @endif href="@if($author->profile->instagram) {{$author->profile->instagram}} @else#@endif" style="width: 16px;height: 16px"  class="social_icon ">
                                                <img src="{{asset('/frontEnd/img/skill-icons_instagram-icon.png')}}" alt="Instagram icon"/>
                                            </a>
                                            <a @if($author->profile->twitter) target="_blank" @endif href="@if($author->profile->twitter) {{$author->profile->twitter}} @else#@endif" style="width: 16px;height: 16px"  class="social_icon ">
                                                <img src="{{asset('/frontEnd/img/logos_pinterest-icon.png')}}" alt="pinterest icon"/>
                                            </a>
                                            <a @if($author->profile->linedin) target="_blank" @endif href="@if($author->profile->linedin){{$author->profile->linedin}} @else#@endif" style="width: 16px;height: 16px"  class="social_icon ">
                                                <img src="{{asset('/frontEnd/img/entypo-social_linkedin-with-circle.png')}}" alt="pinterest icon"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Testimonial 2 -->
                    {{--<div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle" src="{{asset('frontEnd/img/author/slide-girl-2.jpg')}}" alt="">
                        </div>
                        <div class="testimonial-name">
                            <h2>Jane Smith</h2>
                            <div>
                                <div class="profession">
                                    <p>Blog Writter</p>
                                    <div class="right_column">
                                        <a href="#" class="social_icon bg_pinterest">
                                            <img src="{{asset('/frontEnd/img/logos_pinterest-icon.png')}}" alt="pinterest icon"/>
                                        </a>
                                        <a href="#" class="social_icon bg_facebook">
                                            <img src="{{asset('/frontEnd/img/logos_facebook-icon.png')}}" alt="facebook icon"/>
                                        </a>
                                        <a href="#" class="social_icon bg_instagram">
                                            <img src="{{asset('/frontEnd/img/skill-icons_instagram-icon.png')}}" alt="Instagram icon"/>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Testimonial 3 -->
                   {{-- <div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle" src="{{asset('frontEnd/img/author/slide-man-1.jpg')}}" alt="">
                        </div>
                        <div class="testimonial-name">
                            <h2>Emily Rose</h2>
                            <div>
                                <div class="profession">
                                    <p>Blog Writter</p>
                                    <div class="right_column">
                                        <a href="#" class="social_icon bg_pinterest">
                                            <img src="{{asset('/frontEnd/img/logos_pinterest-icon.png')}}" alt="pinterest icon"/>
                                        </a>
                                        <a href="#" class="social_icon bg_facebook">
                                            <img src="{{asset('/frontEnd/img/logos_facebook-icon.png')}}" alt="facebook icon"/>
                                        </a>
                                        <a href="#" class="social_icon bg_instagram">
                                            <img src="{{asset('/frontEnd/img/skill-icons_instagram-icon.png')}}" alt="Instagram icon"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Testimonial 4 -->
                   {{-- <div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle" src="{{asset('frontEnd/img/author/slide-man-1.jpg')}}" alt="">
                        </div>
                        <div class="testimonial-name">
                            <h2>Jane Smith</h2>
                            <div>
                                <div class="profession">
                                    <p>Blog Writter</p>
                                    <div class="right_column">
                                        <a href="#" class="social_icon bg_pinterest">
                                            <img src="{{asset('/frontEnd/img/logos_pinterest-icon.png')}}" alt="pinterest icon"/>
                                        </a>
                                        <a href="#" class="social_icon bg_facebook">
                                            <img src="{{asset('/frontEnd/img/logos_facebook-icon.png')}}" alt="facebook icon"/>
                                        </a>
                                        <a href="#" class="social_icon bg_instagram">
                                            <img src="{{asset('/frontEnd/img/skill-icons_instagram-icon.png')}}" alt="Instagram icon"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</section>



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Custom JS -->
<script>
    jQuery(document).ready(function($) {
        "use strict";
        $('#customers-testimonials').owlCarousel({
            loop: true,
            center: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots: true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1200:{
                    items:3
                }
            }
        });
    });
</script>