@extends('frontEnd.layouts.app')

@section('contents')
    <section class="p-0">
        {{--menu section--}}
        <div class="container">
            @include('frontEnd.header')
        </div>
        <div class="underline"></div>
    </section>
    <div class="container">
        <section class="p-0">
            <div class="breadcrumb_design">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb_item"><a href="/">Home</a></li>
                  <li class="breadcrumb_item active" aria-current="page">About US</li>
                </ol>
              </nav>
            </div>
          </section>
    </div>
    <div class="container">
        <section class="about-us">
            <div class="left-panel">
                <div class="illustration">
                    <img src="{{asset('frontEnd/img/Vector-img.png')}}" alt="Engaging Education" />
                </div>
            </div>
    
            <div class="right-panel">
                <div class="our-author" style="background-color: #EFEBFF;">ABOUT US</div>
                <div class="about-header">
                    <h2>Your Trusted Partner in Engaging Education</h2>
                    <p>We believe that every child deserves access to fun, engaging, and effective learning resources. That's why we created Print & Use, a treasure trove of downloadable activities, printable books, and interactive tools.</p>
                </div>
                <div class="about_widget">
                    <div class="about_widget_left generator_icon_bg">
                        <img src="{{asset('/frontEnd/img/fi_92320841.png')}}" alt="" />
                    </div>
                    <div class="about_widget_right ">
                        <h4>Created by Educators</h4>
                        <p>Our resources are developed by experienced teachers and early childhood
                            specialists, ensuring they're aligned with educational standards and promote essential
                            skills.</p>

                    </div>
                </div>
                <div class="about_widget">
                    <div class="about_widget_left generator_icon_bg">
                        <img src="{{asset('/frontEnd/img/fi_14575714.png')}}" alt="" />
                    </div>
                    <div class="about_widget_right">
                        <h4>Variety for Every Learner</h4>
                        <p>Discover a diverse collection of resources catering to different learning
                            styles, subjects, and age groups. From colorful coloring pages to challenging puzzles
                            and brain-teasing word games, we have something for everyone.</p>

                    </div>
                </div>
                <div class="about_widget">
                    <div class="about_widget_left generator_icon_bg">
                        <img src="{{asset('/frontEnd/img/fi_1007975.png')}}" alt="" />
                    </div>
                    <div class="about_widget_right">
                        <h4>Free and Accessible</h4>
                        <p>We believe all children deserve a chance to learn, regardless of background. That's why
                            we offer our resources completely free of charge, making them accessible to everyone.
                        </p>

                    </div>
                </div>
            </div>
        </section>
        <section class="main-mission-vision-section">
            <div class="mission-vision-container">
                <div class="card mission">
                    <img src="{{asset('frontEnd/img/Vector-mission.png')}}" alt="Mission Image" class="card-image">
                    <h2>Our Mission:</h2>
                    <p>
                        Our mission is to create a one-stop shop for parents, educators, and caregivers seeking innovative and interactive activities for kids. We strive to:
                    </p>
                    <ul>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Make Learning Fun</li>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Spark Creativity and Imagination</li>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Empower Parents & Educators</li>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Promote Inclusivity and Accessibility</li>
                    </ul>
                </div>
                <div class="card vision">
                    <h2>Our Vision:</h2>
                    <p>
                        We envision a world where children are excited to learn, overflowing with curiosity, and empowered to reach their full potential.
                    </p>
                    <ul>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Make Learning Fun</li>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Spark Creativity and Imagination</li>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Empower Parents & Educators</li>
                        <li><img src="{{asset('frontEnd/img/check-container-icon.png')}}" alt="check icon">Promote Inclusivity and Accessibility</li>
                    </ul>
                    <img src="{{asset('frontEnd/img/Vector-vision.png')}}" alt="Vision Image" class="card-image">
                </div>
            </div>
        </section>
    </div>

<style>

h2 {
    margin-top: 10px;
    color: #2d2d2d;
    font-size: 1.5em;
}

/* about us css design  */

.about-us {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #fff;
}

.left-panel, .right-panel {
    width: 50%; /* Ensure both panels take up 50% width */
    padding: 20px;
}

.left-panel {
    position: relative; /* This allows the absolute element to be positioned relative to this panel */
    text-align: center;
    padding: 20px;
}

.left-panel .illustration img {
    width: 100%;
    max-width: 400px;
    border-radius: 15px;
}

.right-panel {
    padding-left: 40px;
}

.about-header h2 {
    color: #333;
    font-size: 2.2rem;
    margin-bottom: 20px;
}

.about-header p {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
}
.features {
    margin-top: 30px;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}


.feature-text {
    display: flex;
    flex-direction: column;
}

.feature-text h3 {
    font-size: 1.4rem;
    margin-bottom: 5px;
    color: #333;
}

.feature-text p {
    color: #777;
    font-size: 1rem;
}

.cta {
    position: absolute;
    bottom: 298px; /* Position 20px from the bottom of the .left-panel */
    left: 24%;
    transform: translateX(-47%); /* Center the .template-count horizontally */
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.template-count {
    background-color: #e91e63;
    color: #fff;
    padding: 15px;
    border-radius: 10px;
    display: inline-block;
    text-align: center;
}

.template-count span {
    font-size: 1.8rem;
    font-weight: bold;
}

.template-count p {
    font-size: 1rem;
}
/* Mission and vision design  */
.main-mission-vision-section {
    padding: 20px 20px;
    background-image: url('//frontEnd/img/missin-vision-bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
}
.mission-vision-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    gap: 20px;
}

.card {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 49%;
}

.card h2 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.card p {
    font-size: 1rem;
    margin-bottom: 15px;
}

.card ul {
    list-style-type: none;
    font-size: 1rem;
    text-align: left;
    margin-top: 10px;
}

.card ul li {
    margin-bottom: 20px;
    padding-left: 10px;
    position: relative;
    display: flex;
    align-items: center;
}

.card ul li img {
    margin-right: 10px;
    width: 20px;
    height: auto;
}

.card-image {
    width: 100%;
    height: auto;
    margin-bottom: 20px;
    border-radius: 10px;
}

</style>

  

@endsection
