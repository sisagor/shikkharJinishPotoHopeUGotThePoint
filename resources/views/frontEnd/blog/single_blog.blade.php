@extends('frontEnd.layouts.app')

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
                    <a href="#" class="social_icon bg_pinterest">
                        <img src="{{asset('/frontEnd/img/logos_pinterest-icon.png')}}" alt="pinterest icon"/>
                    </a>
                    <a href="#" class="social_icon bg_facebook">
                        <img src="{{asset('/frontEnd/img/logos_facebook-icon.png')}}" alt="facebook icon"/>
                    </a>
                    <a href="#" class="social_icon bg_instagram">
                        <img src="{{asset('/frontEnd/img/skill-icons_instagram-icon.png')}}" alt="Instagram icon"/>
                    </a>
                    <a href="#" class="social_icon bg_twitter">
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
                {{-- <h4>Why Coloring is Great for Kids:</h4> --}}
                {{-- <ol>
                    <li><strong>Animals:</strong> Coloring pages featuring their favorite animals, from majestic lions to playful puppies, can spark children's curiosity about the natural world.</li>
                    <li><strong>Nature:</strong> Lush landscapes, vibrant flowers, and majestic trees can be a gateway to appreciating the beauty of nature.</li>
                    <li><strong>Underwater Adventures:</strong> Dive into a world of colorful fish, playful dolphins, and whimsical sea creatures.</li>
                    <li><strong>Mandala Magic:</strong> Explore intricate mandala designs that promote mindfulness and relaxation for both kids and adults.</li>
                    <li><strong>Holidays & Seasons:</strong> Celebrate special occasions with themed coloring pages featuring pumpkins for Halloween, snowflakes for winter, or fireworks for the Fourth of July.</li>
                    <li><strong>Mazes & Activities:</strong> Combine coloring with problem-solving skills with coloring pages featuring mazes, puzzles, and hidden object games.</li>
                    <li><strong>Storytelling Adventures:</strong> Coloring pages that depict scenes from children's favorite stories can bring those stories to life and encourage reading comprehension.</li>
                </ol> --}}


                @if($blogBooks)
                   <div class="row">
                        @foreach($blogBooks as $blogBook)
                            <div class="col-md-4">
                                @if($blogBook->book)
                                    <img src="{{get_storage_file_url(optional($blogBook->book->image)->path)}}" alt="book image" style="display:block;margin: auto;width: inherit;">
                                    <a target="_blank" href="{{$blogBook->book->url}}" class="download-button mt-3">
                                        <img src="{{asset('/frontEnd/img/download-04.png')}}" alt="download icon" class="download_icon">
                                        Download this Book
                                    </a>
                                @endif
                            </div>
                        @endforeach
                   </div>

                @endif
            </div>

            @if(!empty($popularBook))
                <img src="{{get_storage_file_url($popularBook->image)}}" alt="book image">
                <a href="{{$popularBook->url}}" class="download-button mt-3 ">
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
                        <h3 class="author-title">{{$blog->user->profile->occupation}}</h3>
                        <p class="author-description">{{$blog->user->profile->about}}</p>
                        <div class="social-media">
                            <a href="{{$blog->user->profile->facebook}}" target="_blank"><img src="{{asset('/frontEnd/img/Vector-facebook.png')}}" alt="facebook"></a>
                            <a href="{{$blog->user->profile->twitter}}" target="_blank"><img src="{{asset('/frontEnd/img/Vector-twitter.png')}}" alt="Twitter"></a>
                            <a href="{{$blog->user->profile->instagram}}" target="_blank"><img src="{{asset('/frontEnd/img/Vectorinstagram.png')}}" alt="Instagram"></a>
                            <a href="{{$blog->user->profile->linkedin}}" target="_blank"><img src="{{asset('/frontEnd/img/Vector-linkedin.png')}}" alt="LinkedIn"></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="navigation-section">
                <div class="row">
                    <div class="col-md-6 text-left">
                        @if ($previousPost)
                            <a href="/blog/{{ $previousPost->slug }}" class="navigation-button">
                                {{-- <span>&#8592;</span> Previous Post: {{ $previousPost->title }} --}}
                                <span>&#8592;</span> Previous Post
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6 text-right">
                        @if ($nextPost)
                            <a href="/blog/{{ $nextPost->slug }}" class="navigation-button">
                                {{-- Next Post: {{ $nextPost->title }} <span>&#8594;</span> --}}
                                Next Post <span>&#8594;</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="latest-blogs-slider mt-3 mb-3">
                <div class="slider">
                    @foreach ($relatedBlogs as $lblog)
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="{{get_storage_file_url($lblog['first_image'] )}}" alt="" class="slider-image">
                                    {{-- <img src="http://127.0.0.1:8000/frontEnd/img/5804202_33970.png" alt="" class="slider-image"> --}}
                                </div>
                                <div class="col-md-7">
                                    <div class="author_date">
                                        <img src="{{asset('/frontEnd/img/calendar.png')}}" width="16px" height="16px" alt="calendar"/>
                                        <p class="author_name">{{ date('d M, Y',strtotime($lblog['created_at']))}}</p>
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
                    @if($comment->user)
                        @if($comment->user->profile->image)
                        <img src="{{get_storage_file_url(optional($comment->user->profile->image)->path, 'tiny_thumb')}}" alt="Author Image" class="author-comment">
                       @endif
                    @else
                        <img src="{{asset('/frontEnd/img/user2.png')}}" alt="Author Image" class="author-comment">
                    @endif
                    <div class="comment-content">
                        <div class="comment-header">
                            <div class="author-details">
                                <h3 class="comment-name">{{$comment->name}}</h3>
                                <p class="comment-title">{{$comment->email}}</p>
                            </div>

                            <!-- Button to trigger modal -->
                            <button type="button" class="reply-button" data-toggle="modal" data-parent-id="{{$comment->id}}" data-target="#replyModal">
                                <span>&#8634;</span> Reply
                            </button>

                            <!-- Modal Structure -->
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
                                    <!-- Form for Reply -->
                                    <form action="{{route('comment')}}" method="post" class="comment-form">
                                        @csrf
                                        <input type="hidden" id="blog_id" name="blog_id" value="{{$blog->id}}">
                                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                                        <input type="hidden" id="parent_id" name="parent_id" value="">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" name="name" placeholder="Your name" required>
                                            </div>
                                            <div class="input-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" placeholder="Your email" required>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <label for="message">Message</label>
                                            <textarea id="message" name="message" placeholder="Write your message" required></textarea>
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
                        @if($comment->user)
                            @if($comment->user->profile->image)
                                <img src="{{get_storage_file_url(optional($comment->user->profile->image)->path, 'tiny_thumb')}}" alt="Author Image" class="author-comment">
                            @endif
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

                {{-- <div class="comment-card">
                    <img src="{{asset('/frontEnd/img/Rectangle 169-comment.png')}}" alt="Author Image" class="author-comment">
                    <div class="comment-content">
                        <div class="comment-header">
                            <div class="author-details">
                                <h3 class="comment-name">Rasel Mondol</h3>
                                <p class="comment-title">UI/UX Designer</p>
                            </div>
                            <a href="#" class="reply-button">
                                <span>&#8634;</span> Reply
                            </a>
                        </div>
                        <p class="comment-text">Competently provide access to fully researched methods of empowerment without sticky models. Credibly morph front-end niche markets.</p>
                    </div>
                </div> --}}
            </div><div class="comment-form-container">
                <h2>Leave your Comment</h2>
                <form action="{{route('comment')}}" method="post" class="comment-form">
                    @csrf
                    <input type="hidden" id="blog_id" name="blog_id" value="{{$blog->id}}">
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                    <div class="form-group">
                        <div class="input-group" style="align-items: flex-start;">
                            <label for="name" style="padding-left: 15px;">Name</label>
                            <input type="text" id="name" name="name" placeholder="Your name" required>
                        </div>
                        <div class="input-group" style="align-items: flex-start;">
                            <label for="email" style="padding-left: 15px;">Email</label>
                            <input type="email" id="email" name="email" placeholder="Your email" required>
                        </div>
                    </div>
                    <div class="input-group" style="align-items: flex-start;">
                        <label for="message" style="padding-left: 15px;">Message</label>
                        <textarea id="message" name="message" placeholder="Write your message" required></textarea>
                    </div>
                    <button type="submit" class="comment-submit-button">Submit Comment</button>
                </form>
            </div>
        </div>
        <div class="sidebar">
            <div class="recent-articles">
                <div class="search-container">
                    <svg class="search-icon" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.414-1.415l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search here">
                    <button class="search-button">Search</button>
                </div>
            </div>
            <div class="recent-articles">
                <h2>Recent Articles</h2>
                <div class="underline"></div> <!-- Added underline -->
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

                {{-- <div class="article">
                    <img src="{{asset('/frontEnd/img/Container-1.png')}}" alt="Article 3">
                    <div class="article-info">
                        <p class="date"><img src="{{asset('/frontEnd/img/calendar-icon.png')}}" alt="calendar-icon"> 2, Sept 2020</p>
                        <h3>How to Prepare Your Child for School</h3>
                    </div>
                </div> --}}
            </div>
            <div class="recent-articles">
                <h2>Popular Articles</h2>
                <div class="underline"></div> <!-- Added underline -->
                @foreach ($popularBlogs as $blog)
                <div class="article">
                    <div class="article_image">
                        <img src="{{get_storage_file_url($blog['first_image'] )}}" alt="Article 1">
                    </div>
                    <div class="article-info">
                        <p class="date"><img src="{{asset('/frontEnd/img/calendar-icon.png')}}" alt="calendar-icon" class="recent_calender">{{ date('d M, Y',strtotime($blog['created_at']))}}</p>
                        <h3><a href="/blog/{{$blog['id']}}"> {{$blog['title']}} </a></h3>
                    </div>
                </div>
                @endforeach
                {{-- <div class="article">
                    <img src="{{asset('/frontEnd/img/Container-1.png')}}" alt="Article 2">
                    <div class="article-info">
                        <p class="date"><img src="{{asset('/frontEnd/img/calendar-icon.png')}}" alt="calendar-icon" class="recent_calender"> 2, Sept 2020</p>
                        <h3>How to Prepare Your Child for School</h3>
                    </div>
                </div> --}}
            </div>
            <div class="tags-section">
                <h2>Tags</h2>
                <div class="underline"></div> <!-- Added underline -->
                <div class="tags">
                    @foreach($tags as $tag)
                    <a href="#" class="tag">{{$tag}}</a>
                    @endforeach
                    {{-- <a href="#" class="tag">Education</a>
                    <a href="#" class="tag">Day Care</a>
                    <a href="#" class="tag">Kindergarten</a>
                    <a href="#" class="tag">Nursery</a>
                    <a href="#" class="tag">Reading</a>
                    <a href="#" class="tag">Arts Class</a>
                    <a href="#" class="tag">Nursery</a>
                    <a href="#" class="tag">Reading</a>--}}
                </div>
            </div>
            <div class="tags-section" style="background: #5B3AFF">
                <h5 class="subscribe_title">Never miss a post</h5>
                <div style="position: relative; display: inline-block; width: 100%;">
                    <input type="email" placeholder="Type your email" id="email-input">
                    <img src="{{asset('/frontEnd/img/Sent-icon.png')}}" alt="Send" id="email-submit-button-sidebar">
                </div>
            </div>
        </div>
    </div>
<style>
    #email-submit-button-sidebar {
        position: absolute;
        right: 10px;
        top: 53%;
        transform: translateY(-50%);
        width: 70px;
        height: 30px;
        cursor: pointer;
    }
  .container2 {
    display: flex;
    flex-direction: row;
    padding:0 20px;
  }
  .content {
      flex: 3;
      /*padding: 20px;*/
      background-color: #ffffff;
      /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
  }
  .blog_content_title {
      font-family: "Baloo Da 2", sans-serif;
      font-weight: 700;
      font-size: 40px;
  }
  .sidebar {
      flex: 1;
      padding: 20px;
      /* margin-left: 20px; */
      background-color: #fff;
      /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
  }
  .author_container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 10px 0;
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
  }
  .right_column span{
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
  /* .single_post_details {
      text-align: center;
  } */
  .download-button {
      display: inline-flex;
      height: 64px;
      padding: 15px 20px;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      gap: 8px;
      flex-shrink: 0;
      border-radius: 92px;
      border-bottom: 4px solid #AA1554;
      background-color: #F01E76;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
  }
  .download_icon {
      color: white;
  }
  .download-button:hover {
      background-color: #E0116B;
  }
  .writer {
      margin-top: 50px;
  }
  .author-card{
      background-color: #5b46f1 !important;
      border-radius: 20px !important;
      /* box-shadow: 0 4px 9px rgba(0, 0, 0, 0.1); */
      padding: 20px !important;
      display: flex !important;
      flex-direction: row !important;
      align-items: center !important;
      color: #ffffff !important;
      position: unset;
      text-align: start;
  }
  .author-info {
      display: flex !important;
      flex-direction: row !important;
  }
  .author-image {
      border-radius: 15px !important;
      width: 100px !important;
      height: 100px !important;
      margin-right: 20px !important;
      object-fit: cover !important;
  }
  .author-details {
      flex: 1 !important;
  }
  .author-name {
      font-size: 24px !important;
      margin: 0 !important;
  }
  .author-title {
      font-size: 18px !important;
      margin:  5px 0 !important;
      text-align: start;
  }
  .author-description {
      font-size: 14px !important;
      margin: 10px 0 !important;
  }
  .social-media {
      margin-top: 15px;
  }
  .social-media a {
      display: inline-block;
      margin-right: 10px;
  }
  .social-media img {
      width: 24px;
      height: 24px;
      transition: transform 0.3s ease;
  }

  .social-media img:hover {
      transform: scale(1.2);
  }
  comment-section {
      width: 100%;
      max-width: 700px;
      margin: 0 auto;
  }

  .comment-card {
      background-color: #f7f7ff;
      border-radius: 20px;
      /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
      padding: 20px;
      display: flex;
      align-items: flex-start;
      margin-bottom: 20px;
  }
  .comment-card.child {
        margin-left: 10%;
        margin-top: -15px;
  }

  .author-comment {
      border-radius: 5px;
      width: 60px;
      height: 60px;
      margin-right: 20px;
      object-fit: cover;
  }

  .comment-content {
      flex: 1;
  }

  .comment-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
  }

  .author-details {
      flex: 1;
  }

  .comment-name {
      font-size: 18px;
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
  }
  .comment-form-container {
      background-color: #f7f7ff;
      padding: 30px;
      border-radius: 20px;
      margin-bottom: 44px;
  }

  .comment-form {
      display: flex;
      flex-direction: column;
  }
  .form-group {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
  }
  .input-group {
      display: flex;
      flex-direction: column;
      flex: 1;
      margin-right: 20px;
  }
  .input-group:last-child {
      margin-right: 0;
  }
  label {
      color: #333333;
      margin-bottom: 5px;
      font-size: 14px;
  }
  input[type="text"],
  input[type="email"],
  textarea {
      width: 100%;
      border: 1px solid #dddddd;
      border-radius: 33px;
      padding: 5px 15px;
      font-size: 14px;
      outline: none;
      background-color: #ffffff;
      transition: border-color 0.3s ease;
  }
  input[type="text"]:focus,
  input[type="email"]:focus,
  textarea:focus {
      border-color: #3d3d5c;
  }

  textarea {
      height: 100px;
      resize: none;
      width: 100%;
      padding: 10px 15px;
      border-radius: 12px;
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

  /* right sidebar design  */
  .search-container {
      display: flex;
      background-color: #fff;
      border-radius: 50px;
      /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
      overflow: hidden;
  }
  .search-container .search-icon {
      font-size: 16px;
      color: #666;
      margin: 16px;
  }
  .search-input {
      border: none !important;
      padding: 12px 20px;
      border-radius: 50px 0 0 50px;
      outline: none !important;
      font-size: 14px;
      color: #777;
      flex: 1;
  }
  .search-input::placeholder {
      color: #b0b0b0;
  }
  .search-button {
      background-color: #F01E76;
      color: #fff;
      border: none;
      padding: 12px 25px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 0 50px 50px 0;
      transition: background-color 0.3s ease;
  }
  .search-button:hover {
      background-color: #f61573;
  }

  /* recent Articles and Popular Article Design  */
  .recent-articles {
      margin-top: 20px;
      background-color: #F7F5FF;
      padding: 20px;
      border-radius: 15px;
      /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
  }

  .recent-articles h2 {
      margin: 0;
      font-size: 18px;
      color: #333;
      margin-bottom: 20px;
  }

  .article {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
  }
  .article_image{
      width: 112px;
      height: 108px;
      border-radius: 16px;
  }
  .article_image img{
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 16px;
  }


  .article-info {
      display: flex;
      flex-direction: column;
      width: 193px;
      height: 76px;
      margin-left: 10px;

  }

  .article-info .date {
      font-size: 12px;
      color: #888;
      margin: 0;
      display: flex;
      align-items: center;
  }
  .date img {
      width: 20px;
      height: 20px;
      margin-right: 5px;
  }

  .article-info h3 {
      margin: 5px 0 0;
      font-size: 14px;
      color: #333;
  }

  /* Tags css Design  */
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

  .underline {
      height: 1px;
      background-color: #E9E9EA;
      margin: 0 auto 20px auto;
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
  }
  .subscribe_title {
      font-family: "Baloo Da 2", sans-serif;
      font-weight: 700;
      font-size: 24px;
      color: #FFFFFF;
  }
  .newsletter-signup {
      background-color: #5B3AFF;
      padding: 20px 30px;
      border-radius: 30px;
      margin-top: 20px;
      /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); */
  }
  .headline {
      color: #fff;
      font-size: 18px;
      margin: 0 0 20px 0;
  }
  .signup-form {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      border-radius: 50px;
      padding: 5px 10px;
  }
  .signup-form input {
      border: none;
      padding: 10px;
      border-radius: 50px;
      flex: 1;
      font-size: 16px;
  }
  .signup-form button {
      background-color: #F01E76;
      border: none;
      padding: 10px;
      border-radius: 50px;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  .navigation-button {
    display: inline-block;
    padding: 6px 20px;
    border-radius: 25px;
    color: #FF3782;
    text-decoration: none;
    font-size: 13px;
    font-weight: bold;
    transition: background-color 0.3s;
    border: 1px solid #FDD5E8;
}
.navigation-button:hover {
    color: #FF3782;
    text-decoration: none
  }
  .latest-blogs-slider .slider {
    display: flex;
    overflow: hidden;
    gap: 15px;

}

.latest-blogs-slider {
    background-color: #f7f7ff;
    padding: 20px;
    border-radius: 20px;
    padding-bottom: 0;
    max-height: 190px;
    width: 100%;
    max-width: 800px;
    margin: auto;
}
.latest-blogs-slider .item {
    display: inline-block;
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
}
.latest-blogs-slider .item img {
   max-width: 90px;
}
.owl-item {
    float: left !important;
    width: 270px !important;
}
.card_title a {
    font-family: "Baloo Da 2";
    font-size: 20px;
    font-weight: 600;
    color: #262528;
}
.card_title a:hover {
    text-decoration: none
  }

  .card_title h4 {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap; /* Avoid breaking the text */
}

.slider-image {
    max-width: 100%; /* Prevent image overflow */
    height: auto;
}


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var replyButtons = document.querySelectorAll('button.reply-button');
    replyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var parentId = button.getAttribute('data-parent-id');
            document.getElementById('parent_id').value = parentId;
            var replyModal = new bootstrap.Modal(document.getElementById('replyModal'));
            replyModal.show();
        });
    });

});

</script>
<script type="text/javascript">
    ;(function ($, window, document) {
        $(document).ready(function () {
            $(".slider").owlCarousel({
                    items: 2,
                    margin: 10,
                    loop: true,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    responsive: {
                        0: { items: 1 },
                        400: { items: 2 },
                        800: { items: 3 }
                    }
                });
        });
    }(window.jQuery, window, document));
</script>


@endsection