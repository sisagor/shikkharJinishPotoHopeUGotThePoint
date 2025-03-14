<div class="container_section">
    <div class="author-section">
        <div class="author-title">
            <div class="our-author">OUR AUTHOR</div>
            <br>
            Meet Our Amazing Author <span class="star"></span>
        </div>
        <div class="group_author_card">
            @foreach ($authors as $author)
                <div class="author-card" style="max-width: 350px;">
                    <img src="{{ get_storage_file_url( ($author->profile->image->path)) }}" alt="Author Image">
                    <div class="social_card p-0">
                        <div class="author-name mt-1">{{$author->profile->name}}</div>
                        <div class="author-info mt-1">Blog Writer</div>
                        {{-- <div class="author-social">
                        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div> --}}
                    </div> 
                </div>
            @endforeach

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