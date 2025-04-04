<?php

namespace App\Http\Controllers\frontEnd;

use App\Models\User;
use App\Models\SeoPage;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Modules\CMS\Entities\Blog;
use Modules\CMS\Entities\Book;
use Modules\CMS\Entities\Comment;
use Modules\CMS\Entities\Contact;
use App\Models\EmailSubscription;
use App\Services\FrontEndService;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Modules\CMS\Entities\BlogBook;
use App\Http\Requests\JobApplicationRequest;
use Modules\Settings\Entities\BlogCategory;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;


class FrontEndController extends Controller
{
    private $service;
    use SEOToolsTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FrontEndService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $seo = SeoPage::where('status', RootModel::STATUS_ACTIVE)->first();

        $this->seo()->setTitle($seo->title);
        $this->seo()->setDescription($seo->description);
        $this->seo()->setCanonical($seo->canonical);
        SEOMeta::addKeyword(explode(',', $seo->keywords));
        SEOMeta::addMeta('article:section', $seo->section, 'property');
        $this->seo()->opengraph()->setUrl($seo->og_url);
        $this->seo()->opengraph()->addProperty('type', $seo->og_type);
        $this->seo()->opengraph()->addProperty('locale', $seo->og_locale);
        //$this->seo()->twitter()->setSite('@mekbiplob');
        $this->seo()->jsonLd()->setType($seo->og_type);
      
        $categories = BlogCategory::active()->pluck('name', 'id');
        $popularBlogs = $this->getPopularBlogDetailsWithFirstimage();
        $latestBlogs = $this->getLatestBlogDetailsWithFirstimage();
        $topCategories = $this->topCategoriesByViewCount();
        $latestBooks = $this->getLatestBook();
        $popularBook = $this->getPopularBooks();

        $authors = User::with(['profile.image']) 
                ->where('level',  \App\Models\User::USER_AUTHOR)
                ->limit(10)
                ->get();

        //$home = BlogDetails::where('type', BlogDetails::TYPE_HOME)->select('content')->first();

        return view('frontEnd.index',
            compact('categories','popularBlogs',
                'latestBlogs', 'authors','topCategories',
                'latestBooks', 'popularBook'
            ));
    }

    public function getPopularBlogDetailsWithFirstimage()
    {
        return Blog::with(['user', 'user.profile.image', 'details', 'details.images'])
                ->orderBy('view', 'desc')
                ->limit(3) 
                ->get()
                ->map(function($blog){
                    $firstImage = $blog->details->flatMap(function($detail){
                        return $detail->images;
                    })->first();

                    return [
                        'title' => $blog->title,
                        'id' => $blog->id,
                        'url_type' => $blog->url_type,
                        'slug' => $blog->slug,
                        'created_by' => (!empty($blog->user) ? $blog->user->name : null),
                        'created_at' => $blog->created_at,
                        'details' => $blog->details->map(function($detail){
                            return $detail->details;
                        })->first(),
                        'first_image' =>  $firstImage ?  $firstImage->path : null,
                        'image' => (!empty($blog->user) ? optional($blog->user->profile->image)->path : null),
                    ];
                });

    }

    public function getLatestBlogDetailsWithFirstimage()
    {
        return Blog::with(['user', 'user.profile.image', 'details', 'details.images'])
                ->orderBy('created_at', 'desc')
                ->limit(3) 
                ->get()
                ->map(function($blog){
                    $firstImage = $blog->details->flatMap(function($detail){
                        return $detail->images;
                    })->first();

                    return [
                        'title' => $blog->title,
                        'id' => $blog->id,
                        'url_type' => $blog->url_type,
                        'slug' => $blog->slug,
                        'created_by' => (!empty($blog->user) ? $blog->user->name : null ),
                        'created_at' => $blog->created_at,
                        'details' => $blog->details->map(function($detail){
                            return $detail->details;
                        })->first(),
                        'first_image' =>  $firstImage ?  $firstImage->path : null,
                        'image' => (!empty($blog->user) ? optional($blog->user->profile->image)->path : null),
                    ];
                });

    }

    public function getRelatedBlogDetailsWithFirstimage($category_id)
    {
        return Blog::with(['user', 'user.profile.image', 'details', 'details.images'])
                ->where('blog_category_id',$category_id)
                ->orderBy('created_at', 'desc')
                ->limit(10) 
                ->get()
                ->map(function($blog){
                    $firstImage = $blog->details->flatMap(function($detail){
                        return $detail->images;
                    })->first();

                    return [
                        'title' => $blog->title,
                        'id' => $blog->id,
                        'url_type' => $blog->url_type,
                        'slug' => $blog->slug,
                        'created_by' => (!empty($blog->user) ? $blog->user->name : null ),
                        'created_at' => $blog->created_at,
                        'details' => $blog->details->map(function($detail){
                            return $detail->details;
                        })->first(),
                        'first_image' =>  $firstImage ?  $firstImage->path : null,
                        'image' => (!empty($blog->user) ? optional($blog->user->profile->image)->path : null),
                    ];
                });

    }

    public function topCategoriesByViewCount()
    {
        // $topCategories = Blog::select('blog_categories.name')
        //     ->with(['blog_categories.image'])
        //     ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
        //     ->groupBy('blog_categories.id', 'blog_categories.name')
        //     ->orderByRaw('SUM(blogs.view_count) DESC')
        //     ->limit(3)
        //     ->pluck('blog_categories.name');

        $topCategories = BlogCategory::select('blog_categories.name', 'blog_categories.id', 'blog_categories.status')
            ->where('blog_categories.status', RootModel::STATUS_ACTIVE)
            ->with('image')
            ->join('blogs', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->groupBy('blog_categories.id', 'blog_categories.name')
            ->orderByRaw('SUM(blogs.view) DESC')
            ->limit(3)
            ->get();

        return $topCategories;
    }

    /**
     * Get latest Books
     * @return Book
     * */
    public function getLatestBook()
    {
        return Book::orderBy('created_at', 'desc')
                ->limit(4) 
                ->get();
    }

    /**
     * Get latest Books
     * @return Book
     * */
    public function getPopularBooks()
    {
        return Book::orderBy('order', 'asc')
                ->limit(4)
                ->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about(Request $request)
    {
        //$about = BlogDetails::where('type', BlogDetails::TYPE_ABOUT)->select('content')->first();
        $about = [];
        return view('frontEnd.about', compact('about'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact(Request $request)
    {
        set_action('settings.update');
        $contact = config('system_settings');
        return view('frontEnd.contact', compact('contact'));
    }


    public function catWiseBlogs(Request $request)
    {
        $data = BlogCategory::with(['blogs' => function($query) {
            $query->with(['user', 'user.profile.image', 'details', 'details.images'])
                  ->orderBy('view', 'desc');
        }])->where('status', RootModel::STATUS_ACTIVE)->limit(10)->get();
    
        $categories = $data->map(function($category) {
            return [
                'category_title' => $category->title,
                'category_name' => $category->name,
                'category_details' => $category->details,
                'id' => $category->id,
                'blogs' => $category->blogs->map(function($blog) {
                    $firstImage = $blog->details->flatMap(function($detail) {
                        return $detail->images;
                    })->first();
    
                    return [
                        'title' => $blog->title,
                        'id' => $blog->id,
                        'slug' => $blog->slug,
                        'url_type' => $blog->url_type,
                        'created_by' => (!empty($blog->user) ? $blog->user->name : null ),
                        'created_at' => $blog->created_at,
                        'details' => $blog->details->map(function($detail) {
                            return $detail->details;
                        })->first(),
                        'first_image' => $firstImage ? $firstImage->path : null,
                        'image' => (!empty($blog->user) ? optional($blog->user->profile->image)->path : null),
                    ];
                })
            ];
        });
        return view('frontEnd.blog.cat_wise_blogs', compact('categories'));
    }

    
    public function blogDetails(Request $request, $slug)
    {

        $blog = Blog::with(['user', 'user.profile.image', 'details', 'details.image'])
            ->where('slug', $slug)
            ->first();

        $seo = SeoPage::where([
                ['status', '=', RootModel::STATUS_ACTIVE],
                ['page_id', '=', $blog->id],
                ['type', '=', 'blog']
            ])->first();

        $tags = array();

        if($seo){
            SEOMeta::addKeyword(explode(',', $seo->keywords));
            $tags = explode(',', $seo->keywords);

            $this->seo()->setTitle($seo->title);
            $this->seo()->setDescription($seo->description);
        }

        $popularBlogs = $this->getPopularBlogDetailsWithFirstimage();

        $latestBlogs = $this->getLatestBlogDetailsWithFirstimage();
        $relatedBlogs = $this->getRelatedBlogDetailsWithFirstimage($blog->blog_category_id);

        $previousPost = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $nextPost = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
        //$latestBlogs = Blog::latest()->limit(5)->get();

        //$popularBook = Book::with('image')->select(Book::$select)->orderBy('view', 'desc')->first();
        $blogBooks = BlogBook::with('book.image')->where('blog_id', $blog->id)->get();
        $comments = Comment::with('replays')->where('blog_id', $blog->id)->where('parent_id',0)->where('status',1)->orderBy('created_at', 'desc')->get();
        //dd($blog);

        return view('frontEnd.blog.single_blog', compact('blog','popularBlogs','latestBlogs','blogBooks','comments','tags','previousPost','nextPost','relatedBlogs'));
    }

    public function comment(Request $request)
    {
        $parent_id = '';
        if($request->get('parent_id')){
            $parent_id = $request->get('parent_id');
        }
        $comment = Comment::create([
                'blog_id' => $request->get('blog_id'),
                'user_id' => $request->get('user_id'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'comment' => $request->get('message'),
                'parent_id' => $parent_id,
                'status' => 0,
            ]);

        return redirect()->back();
    }

    public function storeContact(Request $request)
    {
        $contact = Contact::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('phone'),
                'message' => $request->get('message')
            ]);

        return redirect()->back();
    }


    public function storeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:email_subscriptions'
        ]);

        EmailSubscription::create([
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'Email stored successfully.');
        
    }

    public function filterBlogs(Request $request)
    {
        $categoryId = $request->input('category_id');

        if ($categoryId) {
            $popularBlogs = Blog::where('blog_category_id', $categoryId)->with(['user', 'user.profile.image', 'details', 'details.images'])
                ->orderBy('view', 'desc')
                ->limit(3) 
                ->get()
                ->map(function($blog){
                    $firstImage = $blog->details->flatMap(function($detail){
                        return $detail->images;
                    })->first();

                    return [
                        'title' => $blog->title,
                        'id' => $blog->id,
                        'url_type' => $blog->url_type,
                        'slug' => $blog->slug,
                        'created_by' => (!empty($blog->user) ? $blog->user->name : null),
                        'created_at' => $blog->created_at,
                        'details' => $blog->details->map(function($detail){
                            return $detail->details;
                        })->first(),
                        'first_image' =>  $firstImage ?  $firstImage->path : null,
                        'image' => (!empty($blog->user) ? optional($blog->user->profile->image)->path : null),
                    ];
                });
        } else {
            $popularBlogs = $this->getPopularBlogDetailsWithFirstimage();
        }

        return view('frontEnd.blog.blog_filter', compact('popularBlogs'));
        
    }

    /**
     * Blog Search
    */
    public function searchBlog(Request $request)
    {
        $data = BlogCategory::with(['blogs' => function($query)use($request)
        {
            $query->with(['user', 'user.profile.image', 'details', 'details.images']);
            if ($request->has('title'))
            {
                $query->where('title', 'LIKE', '%'.$request->get('title').'%');
            }
            return $query->orderBy('view', 'desc');
        }]);

        if ($request->get('cat') != "all")
        {
            $data = $data->where('id', $request->get('cat'));
        }

        $data = $data->active()->limit(10)->get();

        $categories = $data->map(function($category) {
            return [
                'category_title' => $category->title,
                'category_name' => $category->name,
                'category_details' => $category->details,
                'id' => $category->id,
                'blogs' => $category->blogs->map(function($blog) {
                    $firstImage = $blog->details->flatMap(function($detail) {
                        return $detail->images;
                    })->first();

                    return [
                        'title' => $blog->title,
                        'id' => $blog->id,
                        'slug' => $blog->slug,
                        'url_type' => $blog->url_type,
                        'created_by' => (!empty($blog->user) ? $blog->user->name : null ),
                        'created_at' => $blog->created_at,
                        'details' => $blog->details->map(function($detail) {
                            return $detail->details;
                        })->first(),
                        'first_image' => $firstImage ? $firstImage->path : null,
                        'image' => (!empty($blog->user) ? optional($blog->user->profile->image)->path : null),
                    ];
                })
            ];
        });
        return view('frontEnd.blog.cat_wise_blogs', compact('categories'));
    }


}
