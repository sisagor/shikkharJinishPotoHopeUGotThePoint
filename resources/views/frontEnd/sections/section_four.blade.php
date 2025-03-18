<section class="testimonials bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="customers-testimonials" class="owl-carousel">
                    <!-- Testimonial 1 -->
                    <div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle" src="{{asset('frontEnd/img/slide-girl-1.jpg')}}" alt="">
                        </div>
                        <div class="testimonial-name">
                            <h2>Jhon Due</h2>
                            <div>
                                <div class="profession">
                                    <p>Engineer</p>
                                    <div class="social_icon">
                                        <a href="#"><span><i class='bx bxl-facebook'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-linkedin'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-instagram'></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle" src="{{asset('frontEnd/img/slide-girl-2.jpg')}}" alt="">
                        </div>
                        <div class="testimonial-name">
                            <h2>Jane Smith</h2>
                            <div>
                                <div class="profession">
                                    <p>Blog Writter</p>
                                    <div class="social_icon">
                                        <a href="#"><span><i class='bx bxl-facebook'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-linkedin'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-instagram'></i></span></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle" src="{{asset('frontEnd/img/slide-man-1.jpg')}}" alt="">
                        </div>
                        <div class="testimonial-name">
                            <h2>Emily Rose</h2>
                            <div>
                                <div class="profession">
                                    <p>Blog Writter</p>
                                    <div class="social_icon">
                                        <a href="#"><span><i class='bx bxl-facebook'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-linkedin'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-instagram'></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 4 -->
                    <div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle" src="{{asset('frontEnd/img/slide-man-1.jpg')}}" alt="">
                        </div>
                        <div class="testimonial-name">
                            <h2>Jane Smith</h2>
                            <div>
                                <div class="profession">
                                    <p>Blog Writter</p>
                                    <div class="social_icon">
                                        <a href="#"><span><i class='bx bxl-facebook'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-linkedin'></i></span></a>
                                        <a href="#"><span><i class='bx bxl-instagram'></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                1170: {
                    items: 3
                }
            }
        });
    });
</script>