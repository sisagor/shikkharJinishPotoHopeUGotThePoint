
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
--}}

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="style.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<div class="container_section">
    <div class="author-section">
        <div class="author-title">
            <div class="our-author">OUR AUTHOR</div>
            <br>
            Meet Our Amazing Author <span class="star"></span>
        </div>
        <div class="group_author_card">
           {{-- @foreach ($authors as $author)
                <div class="author-card" style="max-width: 350px;">
                    <img src="{{ get_storage_file_url( ($author->profile->image->path)) }}" alt="Author Image">
                    <div class="social_card p-0">
                        <div class="author-name mt-1">{{$author->profile->name}}</div>
                        <div class="author-info mt-1">Blog Writer</div>
                        --}}{{-- <div class="author-social">
                        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div> --}}{{--
                    </div> 
                </div>
            @endforeach--}}

            <div id="customers-testimonials" class="owl-carousel">
                <!-- Testimonial 1 -->
                <div class="item author-card">
                    <div class="shadow-effect">
                        <img class="img-circle" src="{{asset('frontEnd/img/author/slide-girl-1.jpg')}}" alt="">
                    </div>
                    <div class="social_card p-0">
                       {{-- <h2>Jhon Due</h2>--}}
                        <div class="author-name mt-1">Author</div>
                        <div class="author-info mt-1">Blog Writer</div>
                        <div class="author-social">
                            <a href="#"><span><i class='bx bxl-facebook' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-linkedin' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-instagram' ></i></span></a>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="item">
                    <div class="shadow-effect">
                        <img class="img-circle" src="{{asset('frontEnd/img/author/slide-girl-2.jpg')}}" alt="">
                    </div>
                    <div class="social_card p-0">
                        {{-- <h2>Jhon Due</h2>--}}
                        <div class="author-name mt-1">Author</div>
                        <div class="author-info mt-1">Blog Writer</div>
                        <div class="author-social">
                            <a href="#"><span><i class='bx bxl-facebook' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-linkedin' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-instagram' ></i></span></a>
                        </div>
                    </div>
                  {{--  <div class="testimonial-name">
                        <h2>Jane Smith</h2>
                        <div>
                            <div class="profession">
                                <p>Blog Writter</p>
                                <div class="social_icon">
                                    <a href="#"><span><i class='bx bxl-facebook' ></i></span></a>
                                    <a href="#"><span><i class='bx bxl-linkedin' ></i></span></a>
                                    <a href="#"><span><i class='bx bxl-instagram' ></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
                <!-- Testimonial 3 -->
                <div class="item">
                    <div class="shadow-effect">
                        <img class="img-circle" src="{{asset('frontEnd/img/author/slide-man-1.jpg')}}" alt="">
                    </div>
                    <div class="social_card p-0">
                        {{-- <h2>Jhon Due</h2>--}}
                        <div class="author-name mt-1">Author</div>
                        <div class="author-info mt-1">Blog Writer</div>
                        <div class="author-social">
                            <a href="#"><span><i class='bx bxl-facebook' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-linkedin' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-instagram' ></i></span></a>
                        </div>
                    </div>
                   {{-- <div class="testimonial-name">
                        <h2>Emily Rose</h2>
                        <div>
                            <div class="profession">
                                <p>Blog Writter</p>
                                <div class="social_icon">
                                    <a href="#"><span><i class='bx bxl-facebook' ></i></span></a>
                                    <a href="#"><span><i class='bx bxl-linkedin' ></i></span></a>
                                    <a href="#"><span><i class='bx bxl-instagram' ></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
                <!-- Testimonial 4 -->
                <div class="item">
                    <div class="shadow-effect">
                        <img class="img-circle" src="{{asset('frontEnd/img/author/slide-man-2.jpg')}}" alt="">
                    </div>
                    <div class="social_card p-0">
                        {{-- <h2>Jhon Due</h2>--}}
                        <div class="author-name mt-1">Author</div>
                        <div class="author-info mt-1">Blog Writer</div>
                        <div class="author-social">
                            <a href="#"><span><i class='bx bxl-facebook' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-linkedin' ></i></span></a>
                            <a href="#"><span><i class='bx bxl-instagram' ></i></span></a>
                        </div>
                    </div>
                  {{--  <div class="testimonial-name">
                        <h2>Jane Smith</h2>
                        <div>
                            <div class="profession">
                                <p>Blog Writter</p>
                                <div class="social_icon">
                                    <a href="#"><span><i class='bx bxl-facebook' ></i></span></i></a>
                                    <a href="#"><span><i class='bx bxl-linkedin' ></i></span></i></a>
                                    <a href="#"><span><i class='bx bxl-instagram' ></i></span></i></a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>

        </div>
       
    </div>
    <div class="author-dots">
        <div class="author-dot active"></div>
        <div class="author-dot"></div>
        <div class="author-dot"></div>
    </div>
</div>




<style>
    .social_card {
        background-color: #51468894;
        color: white;
        margin: 5px 20px;
        padding: 10px;
        border-radius: 0;
        border-bottom-left-radius: 10px;
        bottom: 15px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        border-bottom-right-radius: 10px;
    }
</style>


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
                    items: 3
                },
                1170: {
                    items: 3
                }
            }
        });
    });
</script>