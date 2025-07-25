@extends('frontEnd.layouts.app')

@section('frontTitle')
    <title>{{$blog->title}}</title>
@endsection

@section('contents')
    <section class="p-0">
        {{--menu section--}}
        @include('frontEnd.partials.header')
    </section>
    <div class="container">
        <section class="py-1">
            <div class="breadcrumb_design">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb_item"><a href="/">Home</a></li>
                        <li class="breadcrumb_item"><a href="/blog/category">Blog</a></li>
                        <li class="breadcrumb_item active" aria-current="page">{{$blog->title}}</li>
                    </ol>
                </nav>
            </div>
        </section>
    </div>

    <div class="container container2">
        <div class="content">
            <h3 class="blog_content_title">{{$blog->title}}</h3>
            <div class="author_container">
                <div class="left_column">
                    @if (!empty($blog->user->profile))
                        <img src="{{get_storage_file_url($blog->user->profile->image->path )}}" alt="author image" class="author_image">
                    @else
                        <img src="{{asset('/frontEnd/img/Ellipse 1981-icon.png')}}" alt="author image" class="author_image">
                    @endif
                    <div class="author_details">
                        <p class="author_name">{{$blog->user->name}}</p>
                        <p class="post_date">{{ date('d M, Y',strtotime($blog->created_at))}}</p>
                    </div>
                </div>
                <div class="right_column">
                    <span>Share: </span>

                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="social_icon bg_facebook">
                        <img src="{{asset('/frontEnd/img/logos_facebook-icon.png')}}" alt="facebook icon"/>
                    </a>


                    <a target="_blank" href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{get_storage_file_url($blog->details[0]->image->path)}}&description={{$blog->title}}" class="social_icon bg_pinterest">
                        <img src="{{asset('/frontEnd/img/logos_pinterest-icon.png')}}" alt="pinterest icon"/>
                    </a>

                    <a href="#" class="social_icon bg_instagram">
                        <img src="{{asset('/frontEnd/img/skill-icons_instagram-icon.png')}}" alt="Instagram icon"/>
                    </a>

                    <a href="https://x.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}"
                       class="social_icon bg_twitter" target="_blank">
                        <img src="{{asset('/frontEnd/img/ant-design_twitter-circle-filled-icon.png')}}" alt="Twitter icon"/>
                    </a>
                </div>
            </div>
            <div class="underline"></div>
            <div class="single_post_details">
                @foreach ($blog->details as $detail)
                    @if ($detail->image)
                        <img src="{{get_storage_file_url($detail->image->path)}}" alt="{{$detail->image->image_alter}}" class="single_img w-100">
                    @endif

                    <p class="mt-1">{!! html_entity_decode($detail->details) !!}</p>
                @endforeach

                @if($blog->blogDoc)
                    {{--Download files--}}
                    <div class="" style="text-align: center">
                        <a href="{{get_storage_file_url(optional($blog->blogDoc)->path)}}" class="download-button mt-3 " style="" download>
                            Download PDF
                        </a>
                    </div>
                @endif

                @if($blogBooks)
                    <div class="row">
                        @foreach($blogBooks as $blogBook)
                            <div class="col-md-4 text-center <!--text-md-left-->">
                                @if($blogBook->book)
                                    <img src="{{get_storage_file_url(optional($blogBook->book->image)->path)}}"
                                         alt="book image"
                                         class="img-fluid d-block mx-auto mx-md-0"
                                         style="max-width: 100%; height: auto;">

                                    <a target="_blank"
                                       href="{{$blogBook->book->url}}"
                                       class="download-button mt-3 d-inline-flex align-items-center justify-content-center justify-content-md-start">
                                        <img src="{{asset('/frontEnd/img/download-04.png')}}"
                                             alt="download icon" class="download_icon me-2">
                                        Check Out This Book
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(!empty($popularBook))
                <img src="{{get_storage_file_url($popularBook->image)}}" alt="book image">
                <a href="{{$popularBook->url}}" class="download-button mt-3">
                    <img src="{{get_storage_file_url($popularBook->image)}}" alt="download icon" class="download_icon">
                    Download this Book
                </a>
            @endif


            <div class="writer">
                <h2>Writer</h2>
            </div>
            <div class="author-card">
                <div class="author-info">
                    @if (!empty($blog->user->profile))
                        <img src="{{get_storage_file_url($blog->user->profile->image->path)}}" alt="author image" class="author-image">
                    @else
                        <img src="{{asset('/frontEnd/img/Ellipse 1981-icon.png')}}" alt="author image" class="author-image">
                    @endif
                    <div class="author-details">
                        <h2 class="author-name">{{$blog->user->name}}</h2>
                        <h3 class="author-title">{{$blog->user->profile->occupation ?? ''}}</h3>
                        <p class="author-description">{{$blog->user->profile->about ?? ''}}</p>
                        <div class="social-media">
                            <a href="{{$blog->user->profile->facebook ?? '#'}}" target="_blank"><img src="{{asset('/frontEnd/img/Vector-facebook.png')}}" alt="facebook"></a>
                            <a href="{{$blog->user->profile->twitter ?? '#'}}" target="_blank"><img src="{{asset('/frontEnd/img/Vector-twitter.png')}}" alt="Twitter"></a>
                            <a href="{{$blog->user->profile->instagram ?? '#'}}" target="_blank"><img src="{{asset('/frontEnd/img/Vectorinstagram.png')}}" alt="Instagram"></a>
                            <a href="{{$blog->user->profile->linkedin ?? '#'}}" target="_blank"><img src="{{asset('/frontEnd/img/Vector-linkedin.png')}}" alt="LinkedIn"></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="navigation-section">
                <div class="row">
                    <div class="col-md-6 text-left">
                        @if ($previousPost)
                            <a href="/blog/{{ $previousPost->slug }}" class="navigation-button">
                                <span>&#8592;</span> Previous Post
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6 text-right">
                        @if ($nextPost)
                            <a href="/blog/{{ $nextPost->slug }}" class="navigation-button">
                                Next Post <span>&#8594;</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="latest-blogs-slider mt-3 mb-3">
                <div class="slider owl-carousel">
                    @foreach ($relatedBlogs as $lblog)
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 p-2">
                                    <img src="{{get_storage_file_url($lblog['first_image'] )}}" alt="" class="slider-image">
                                </div>
                                <div class="col-md-7 p-0 m-0">
                                    <div class="slide_author_date">
                                        <div class="mt-2">
                                            <img class="slider_claender_icon" src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                                        </div>
                                        <p class="slide_author_name mt-2">{{ date('d M, Y',strtotime($lblog['created_at']))}}</p>
                                    </div>
                                    <div class="card_title">
                                        <h4><a href="/blog/{{ $lblog['slug'] }}">{{ $lblog['title'] }}</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="comment-section">
                <h2>{{count($comments)}} Comments:</h2>
                @foreach($comments as $comment)
                    <div class="comment-card">
                        @if($comment->user && $comment->user->profile && $comment->user->profile->image)
                            <img src="{{get_storage_file_url(optional($comment->user->profile->image)->path, 'tiny_thumb')}}" alt="Author Image" class="author-comment">
                        @else
                            <img src="{{asset('/frontEnd/img/user2.png')}}" alt="Author Image" class="author-comment">
                        @endif
                        <div class="comment-content">
                            <div class="comment-header">
                                <div class="author-details">
                                    <h3 class="comment-name">{{$comment->name}}</h3>
                                    <p class="comment-title">{{$comment->email}}</p>
                                </div>

                                <button type="button" class="reply-button" data-toggle="modal" data-parent-id="{{$comment->id}}" data-target="#replyModal">
                                    <span>&#8634;</span> Reply
                                </button>

                                <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="replyModalLabel">Reply to Comment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('comment')}}" method="post" class="comment-form">
                                                    @csrf
                                                    <input type="hidden" id="blog_id" name="blog_id" value="{{$blog->id}}">
                                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                                                    <input type="hidden" id="parent_id" name="parent_id" value="">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-input-blog" id="name" name="name" placeholder="Your name" required>
                                                        </div>
                                                        <div class="input-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-input-blog" id="email" name="email" placeholder="Your email" required>
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <label for="message">Message</label>
                                                        <textarea class="form-input-blog" id="message" name="message" placeholder="Write your message" required></textarea>
                                                    </div>
                                                    <button type="submit" class="comment-submit-button">Submit Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="comment-text">{{$comment->comment}}</p>
                        </div>
                    </div>
                    @if(count($comment['replays']) > 0)
                        @foreach($comment['replays'] as $rcomment)
                            <div class="comment-card child">
                                @if($rcomment->user && $rcomment->user->profile && $rcomment->user->profile->image)
                                    <img src="{{get_storage_file_url(optional($rcomment->user->profile->image)->path, 'tiny_thumb')}}" alt="Author Image" class="author-comment">
                                @else
                                    <img src="{{asset('/frontEnd/img/user2.png')}}" alt="Author Image" class="author-comment">
                                @endif
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <div class="author-details">
                                            <h3 class="comment-name">{{$rcomment->name}}</h3>
                                            <p class="comment-title">{{$rcomment->email}}</p>
                                        </div>
                                    </div>
                                    <p class="comment-text">{{$rcomment->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>

            <div class="comment-form-container">
                <h2>Leave your Comment</h2>
                <form action="{{route('comment')}}" method="post" class="comment-form">
                    @csrf
                    <input type="hidden" id="blog_id" name="blog_id" value="{{$blog->id}}">
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="name">Name</label>
                            <input class="form-input-blog" type="text" id="name" name="name" placeholder="Your name" required>
                        </div>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input class="form-input-blog" type="email" id="email" name="email" placeholder="Your email" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="message">Message</label>
                        <textarea class="form-input-blog" id="message" name="message" placeholder="Write your message" required></textarea>
                    </div>
                    <button type="submit" class="comment-submit-button">Submit Comment</button>
                </form>
            </div>
        </div>

        <div class="sidebar">
            <div class="recent-articles">
                <form action="{{route('blog.search')}}" target="_blank" method="get">
                    <div class="search-container">
                        <svg class="search-icon" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.414-1.415l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        <input type="text" class="search-input"  name="title" placeholder="Search here">
                        <input type="hidden" class="search-input" name="cat" value="all">
                        <button type="submit" class="search-button">Search</button>
                    </div>
                </form>
            </div>
            <div class="recent-articles">
                <h2>Recent Articles</h2>
                <div class="underline"></div>
                @foreach ($latestBlogs as $blog)
                    <div class="article">
                        <div class="article_image">
                            <img src="{{get_storage_file_url($blog['first_image'] )}}" alt="Article 1">
                        </div>
                        <div class="article-info">
                            <p class="date"><img src="{{asset('/frontEnd/img/calendar-icon.png')}}" alt="calendar-icon" class="recent_calender">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                            <h3><a href="/blog/{{$blog['slug']}}">{{$blog['title']}}</a></h3>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="recent-articles">
                <h2>Popular Articles</h2>
                <div class="underline"></div>
                @foreach ($popularBlogs as $blog)
                    <div class="article">
                        <div class="article_image">
                            <img src="{{get_storage_file_url($blog['first_image'] )}}" alt="Article 1">
                        </div>
                        <div class="article-info">
                            <p class="date"><img src="{{asset('/frontEnd/img/calendar-icon.png')}}" alt="calendar-icon" class="recent_calender">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                            <h3><a href="/blog/{{$blog['slug']}}"> {{$blog['title']}} </a></h3>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tags-section">
                <h2>Tags</h2>
                <div class="underline"></div>
                <div class="tags">
                    @foreach($tags as $tag)
                        <a href="#" class="tag">{{$tag}}</a>
                    @endforeach
                </div>
            </div>
            <div class="tags-section" style="background: #5B3AFF;margin-bottom: 30px">
                <h5 class="subscribe_title">Never miss a post</h5>
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input type="email" placeholder="Type your email" id="email-input">
                    <img src="{{asset('/frontEnd/img/Sent-icon.png')}}" alt="Send" id="email-submit-button-sidebar">
                </div>
            </div>
        </div>
    </div>


    {{--Styles--}}
    <style>
        /* Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Rubik', sans-serif;
            line-height: 1.6;
            color: #333;
        }


        a {
            text-decoration: none;
            color: inherit;
        }

        /* Layout */
        .container2 {
            display: flex;
            flex-direction: column;
            padding: 0 15px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            box-sizing: border-box;
        }

        @media (min-width: 992px) {
            .container2 {
                flex-direction: row;
                padding: 0 20px;
            }
        }

        .content {
            width: 60%;
            padding: 15px;
            background-color: #ffffff;
        }

        @media (min-width: 992px) {
            .content {
                flex: 3;
                padding: 20px;
            }
        }

        .sidebar {
            width: 40%;
            padding: 15px;
            background-color: #fff;
        }
        .slider-image {
            width: 100%;
            height: 100px;
        }
        @media (min-width: 992px) {
            .sidebar {
                flex: 1;
                margin-left: 0;
                padding: 20px;
            }
        }

        /* Typography */
        .blog_content_title {
            font-family: "Baloo Da 2", sans-serif;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .blog_content_title {
                font-size: 40px;
            }
        }

        /* Author Section */
        .author_container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            background-color: #fff;
            padding: 10px 0;
            gap: 15px;
        }

        @media (min-width: 576px) {
            .author_container {
                flex-direction: row;
                gap: 0;
            }
        }

        .left_column {
            display: flex;
            align-items: center;
        }

        .author_image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .author_details {
            display: flex;
            flex-direction: column;
        }

        .author_name {
            font-size: 14px;
            font-family: "Rubik", sans-serif;
            font-weight: 600;
            color: #262528;
            margin: 0;
        }
        .slide_author_name {
            font-size: 12px;
            margin-left: 5px;
        }

        .post_date {
            font-size: 12px;
            color: #424244;
            font-family: "Rubik", sans-serif;
            font-weight: 400;
            margin: 0;
        }

        .right_column {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .right_column span {
            font-family: "Rubik", sans-serif;
            font-weight: 700;
            font-size: 16px;
            color: #262528;
        }

        .social_icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 32px;
            height: 32px;
            transition: background-color 0.3s;
            border-radius: 8px;
        }

        .social_icon img {
            width: 16px;
            height: 16px;
            display: block;
        }

        .bg_facebook {
            background: rgba(24, 119, 242, 0.08);
        }

        .bg_instagram {
            background: linear-gradient(180deg, rgba(255, 208, 83, 0.08) 0%, rgba(201, 56, 172, 0.08) 55%, rgba(24, 119, 242, 0.08) 100%);
        }

        .bg_twitter {
            background: rgba(29, 155, 240, 0.08);
        }

        .bg_pinterest {
            background: rgba(203, 31, 39, 0.08);
        }

        .bg_facebook:hover {
            border: 0.5px dashed #1877F2;
            background: rgba(24, 119, 242, 0.08);
        }

        .bg_instagram:hover {
            border: 0.5px dashed #C938AC;
            background: linear-gradient(180deg, rgba(255, 208, 83, 0.08) 0%, rgba(201, 56, 172, 0.08) 55%, rgba(24, 119, 242, 0.08) 100%);
        }

        .bg_twitter:hover {
            border: 0.5px dashed #1D9BF0;
            background: rgba(29, 155, 240, 0.08);
        }

        .bg_pinterest:hover {
            border: 0.5px dashed #CB1F27;
            background: rgba(203, 31, 39, 0.08);
        }

        .underline {
            height: 1px;
            background-color: #E9E9EA;
            margin: 0 auto 20px auto;
        }

        /* Post Details */
        .single_post_details p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.8;
            overflow-wrap: break-word;
        }

        .single_img {
            margin-bottom: 20px;
            border-radius: 10px;
        }

        /* Download Button */
        .download-button {
            display: inline-flex;
            height: 50px;
            padding: 10px 15px;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 92px;
            border-bottom: 4px solid #AA1554;
            background-color: #F01E76;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin-bottom: 20px;
        }

        @media (min-width: 576px) {
            .download-button {
                height: 50px;
                padding: 15px 20px;
                font-size: 14px;
            }
        }

        .download_icon {
            color: white;
            width: 16px;
            height: 16px;
        }

        .download-button:hover {
            background-color: #E0116B;
        }

        /* Author Card */
        .author-card {
            background-color: #5b46f1;
            border-radius: 20px;
            padding: 20px;
            color: #ffffff;
            margin: 30px 0;
        }


        .author-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .author-image {
            border-radius: 15px;
            width: 80px!important;
            height: 80px!important;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .author-details {
            width: 100%;
        }

        .author-name {
            font-size: 20px;
            margin: 0 0 5px 0;
        }

        .author-title {
            font-size: 16px;
            margin: 0 0 10px 0;
        }

        .author-description {
            font-size: 14px;
            margin: 0 0 15px 0;
            line-height: 1.6;
        }

        .social-media {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .social-media a {
            display: inline-block;
        }

        .social-media img {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        .social-media img:hover {
            transform: scale(1.2);
        }

        /* Desktop styles */
        @media (min-width: 768px) {
            .author-info {
                flex-direction: row;
                align-items: flex-start;
                text-align: left;
            }

            .author-image {
                width: 100px;
                height: 100px;
                margin-right: 20px;
                margin-bottom: 0;
            }

            .author-name {
                font-size: 24px;
            }

            .author-title {
                font-size: 18px;
                text-align: left;
            }

            .social-media {
                justify-content: flex-start;
            }

            .social-media img {
                width: 24px;
                height: 24px;
            }
        }
        /* Navigation Section */
        .navigation-section {
            margin: 30px 0;
        }

        .navigation-section .row {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        @media (min-width: 768px) {
            .navigation-section .row {
                flex-direction: row;
                gap: 0;
            }
        }

        .navigation-section .col-md-6 {
            width: 100%;
            text-align: center !important;
        }

        @media (min-width: 768px) {
            .navigation-section .col-md-6 {
                width: 50%;
                text-align: left !important;
            }

            .navigation-section .col-md-6.text-right {
                text-align: right !important;
            }
        }

        .navigation-button {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 25px;
            color: #FF3782;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: background-color 0.3s;
            border: 1px solid #FDD5E8;
        }

        @media (min-width: 576px) {
            .navigation-button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        .navigation-button:hover {
            color: #FF3782;
            text-decoration: none;
            background-color: #FDD5E8;
        }

        /* Latest Blogs Slider */
        .latest-blogs-slider {
            background-color: #f7f7ff;
            padding: 15px;
            border-radius: 20px;
            margin: 30px 0;
        }

        @media (min-width: 768px) {
            .latest-blogs-slider {
                padding: 20px;
            }
        }

        .latest-blogs-slider .slider {
            display: flex;
            overflow: hidden;
            gap: 5px;
        }

        .latest-blogs-slider .item {
            min-width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        @media (min-width: 576px) {
            .latest-blogs-slider .item {
                min-width: 50%;
            }
        }

        @media (min-width: 992px) {
            .latest-blogs-slider .item {
                min-width: 33.33%;
            }
        }

        .latest-blogs-slider {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .slider_claender_icon {
            width: 16px;
            height: 16px;
        }
        .slide_author_date {
            display: flex;
            margin: 0px 10px;
        }
        .author-name{
            font-size: 24px;
        }

        .author_date img {
            margin-right: 5px;
        }

        .card_title h4 {
            font-family: "Baloo Da 2";
            font-size: 16px;
            font-weight: 600;
            color: #262528;
            margin: 0;
            padding: 0 10px;
        }

        .card_title a:hover {
            text-decoration: none;
            color: #F01E76;
        }

        /* Comment Section */
        .comment-section {
            margin: 30px 0;
        }

        .comment-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .comment-card {
            background-color: #f7f7ff;
            border-radius: 20px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .comment-card {
                flex-direction: row;
                padding: 20px;
            }
        }

        .comment-card.child {
            margin-left: 5%;
            margin-top: 15px;
        }

        @media (min-width: 768px) {
            .comment-card.child {
                margin-left: 10%;
                margin-top: -15px;
            }
        }

        .author-comment {
            border-radius: 5px;
            width: 50px;
            height: 50px;
            margin-right: 0;
            margin-bottom: 15px;
            object-fit: cover;
        }

        @media (min-width: 768px) {
            .author-comment {
                width: 60px;
                height: 60px;
                margin-right: 20px;
                margin-bottom: 0;
            }
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        @media (min-width: 576px) {
            .comment-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .comment-name {
            font-size: 16px;
            margin: 0;
            color: #333333;
        }

        .comment-title {
            font-size: 14px;
            color: #777777;
            margin: 5px 0 0;
        }

        .reply-button {
            background-color: #ffffff;
            color: #f542c6;
            border: 2px solid #f542c6;
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin-top: 10px;
        }

        @media (min-width: 576px) {
            .reply-button {
                margin-top: 0;
            }
        }

        .reply-button span {
            margin-right: 5px;
        }

        .reply-button:hover {
            background-color: #f542c6;
            color: #ffffff;
        }

        .comment-text {
            font-size: 14px;
            color: #555555;
            margin: 10px 0 0;
            line-height: 1.6;
        }

        /* Comment Form */
        .comment-form-container {
            background-color: #f7f7ff;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 30px;
        }

        .comment-form-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .comment-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        @media (min-width: 768px) {
            .form-group {
                flex-direction: row;
                justify-content: space-between;
                margin-bottom: 20px;
            }
        }


        .input-group {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin-bottom: 15px;
        }

        @media (min-width: 768px) {
            .input-group {
                margin-right: 20px;
                margin-bottom: 0;
            }

            .input-group:last-child {
                margin-right: 0;
            }
        }

        label {
            color: #333333;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        /*input[type="text"],*/
        /*input[type="email"],*/
        /*textarea {*/
        /*    width: 100%;*/
        /*    border: 1px solid #dddddd;*/
        /*    border-radius: 33px;*/
        /*    padding: 10px 15px;*/
        /*    font-size: 14px;*/
        /*    outline: none;*/
        /*    background-color: #ffffff;*/
        /*    transition: border-color 0.3s ease;*/
        /*}*/
        .form-input-blog {
            width: 100%;
            border: 1px solid #dddddd;
            border-radius: 33px;
            padding: 10px 15px;
            font-size: 14px;
            outline: none;
            background-color: #ffffff;
            transition: border-color 0.3s ease;
        }

        textarea {
            height: 120px;
            resize: none;
            border-radius: 12px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: #3d3d5c;
        }

        .comment-submit-button {
            margin-top: 20px;
            background-color: #F01E76;
            color: #ffffff;
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            border-bottom: 4px solid #AA1554;
        }

        .comment-submit-button:hover {
            background-color: #E0116B;
        }

        /* Sidebar Styles */
        .recent-articles {
            margin-top: 20px;
            background-color: #F7F5FF;
            padding: 20px;
            border-radius: 15px;
        }

        .recent-articles h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .article {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        @media (min-width: 576px) {
            .article {
                flex-direction: row;
                width: 100%;
            }
        }

        .article_image {
            width: 100%;
            height: auto;
            border-radius: 16px;
            margin-bottom: 10px;
        }
        .article_image img {
            width: 100px;
            height: 100px;
        }
        @media (min-width: 576px) {
            .article_image {
                width: 112px;
                height: 108px;
                margin-bottom: 0;
            }
        }

        .article-info {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-left: 0;
        }

        @media (min-width: 576px) {
            .article-info {
                width: calc(100% - 122px);
                margin-left: 10px;
            }
        }

        .article-info .date {
            font-size: 12px;
            color: #888;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .date img {
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }

        .article-info h3 {
            margin: 5px 0 0;
            font-size: 14px;
            color: #333;
            line-height: 1.4;
        }

        /* Search Container */
        .search-container {
            display: flex;
            background-color: #fff;
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .search-icon {
            font-size: 16px;
            color: #666;
            margin: 16px;
        }

        .search-input {
            border: none !important;
            padding: 12px 15px;
            font-size: 14px;
            color: #777;
            flex: 1;
            outline: none;
        }

        .search-input::placeholder {
            color: #b0b0b0;
        }

        .search-button {
            background-color: #F01E76;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        @media (min-width: 576px) {
            .search-button {
                padding: 12px 25px;
                font-size: 16px;
            }
        }

        .search-button:hover {
            background-color: #f61573;
        }

        /* Tags Section */
        .tags-section {
            margin-top: 20px;
            background-color: #F7F5FF;
            padding: 20px;
            border-radius: 15px;
        }

        .tags-section h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 14px;
            color: #333;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .tag:hover {
            background-color: #f0f0f0;
            border-color: #ccc;
            color: #F01E76;
        }

        /* Subscribe Section */
        .subscribe_title {
            font-family: "Baloo Da 2", sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: #FFFFFF;
            margin-bottom: 15px;
        }

        #email-input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 50px;
            border: none;
            outline: none;
            font-size: 14px;
        }

        #email-submit-button-sidebar {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 66px;
            cursor: pointer;
        }

        /* Modal Styles */
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .modal-title {
            font-weight: 600;
        }

        .close {
            font-size: 24px;
        }

        /* Responsive Images */
        .single_img {
            max-width: 100%;
            height: auto;
        }

        /* Utility Classes */
        .mt-1 {
            margin-top: 10px;
        }

        .mt-3 {
            margin-top: 20px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .w-100 {
            width: 100%;
        }

    </style>

@endsection

@section('frontJs')
  {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />--}}
    {{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>--}}

    <script>

        $(document).ready(function() {
            // Reply button logic
            $('button.reply-button').on('click', function() {
                var parentId = $(this).data('parent-id');
                $('#parent_id').val(parentId);
            });


            $('.bg_instagram').on('click', function()
            {
                alert('Copy the URL and save the image then post it to instagram manually. URL: {{url()->current()}}');
            });

            // Owl Carousel
            $('.owl-carousel').owlCarousel({
                items: 1,
                margin: 10,
                loop: true,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2000,
                responsive: {
                    0: { items: 1 },
                    576: { items: 2 },
                    992: { items: 3 }
                }
            });
        });
    </script>

@endsection
