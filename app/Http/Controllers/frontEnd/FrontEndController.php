<?php

namespace App\Http\Controllers\frontEnd;


use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\CMS\Entities\Blog;
use Modules\CMS\Entities\Book;
use Modules\CMS\Entities\Comment;
use Modules\CMS\Entities\Contact;
use App\Models\SeoPage;
use App\Services\FrontEndService;
use App\Http\Controllers\Controller;
use Modules\CMS\Entities\BlogDetails;
use App\Http\Requests\JobApplicationRequest;
use Modules\Settings\Entities\BlogCategory;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

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

        $authors = User::with(['profile.image']) 
                ->where('level',  \App\Models\User::USER_AUTHOR)
                ->limit(3)
                ->get();

        //$home = BlogDetails::where('type', BlogDetails::TYPE_HOME)->select('content')->first();

        return view('frontEnd.index', compact('categories','popularBlogs', 'latestBlogs', 'authors','topCategories', 'latestBooks'));
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

        $topCategories = BlogCategory::select('blog_categories.name', 'blog_categories.id')
            ->with('image')
            ->join('blogs', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->groupBy('blog_categories.id', 'blog_categories.name')
            ->orderByRaw('SUM(blogs.view) DESC')
            ->limit(3)
            ->get();

        return $topCategories;
    }

    public function getLatestBook()
    {
        return Book::orderBy('created_at', 'desc')
                ->limit(3) 
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
        }])->limit(10)->get();
    
        $categories = $data->map(function($category) {
            return [
                'category_name' => $category->name,
                'id' => $category->id,
                'blogs' => $category->blogs->map(function($blog) {
                    $firstImage = $blog->details->flatMap(function($detail) {
                        return $detail->images;
                    })->first();
    
                    return [
                        'title' => $blog->title,
                        'id' => $blog->id,
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

    
    public function blogDetails(Request $request, $id)
    {

        $seo = SeoPage::where([
                ['status', '=', RootModel::STATUS_ACTIVE],
                ['page_id', '=', $id],
                ['type', '=', 'blog']
            ])->first();

        $tags = array();

        if($seo){
            SEOMeta::addKeyword(explode(',', $seo->keywords));
            $tags = explode(',', $seo->keywords);
        }

        $blog = Blog::with(['user', 'user.profile.image', 'details', 'details.image'])
                    ->where('id', $id)
                    ->first();

        $popularBlogs = $this->getPopularBlogDetailsWithFirstimage();

        $latestBlogs = $this->getLatestBlogDetailsWithFirstimage();

        $popularBook = Book::orderBy('view', 'desc')->first();
        $comments = Comment::with('replays')->where('parent_id',0)->orderBy('created_at', 'desc')->get();

        return view('frontEnd.blog.single_blog', compact('blog','popularBlogs','latestBlogs','popularBook','comments','tags'));
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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function jobs(Request $request)
    {
        $jobs = $this->service->jobs($request);

        return view('frontEnd.jobs.jobs', compact('jobs'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function jobShow(Request $request, $id)
    {
        $job = $this->service->job($request, $id);

        return view('frontEnd.jobs.show', compact('job'));
    }

    /**
     * Apply load
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function jobApply(Request $request, $id)
    {
        $job = $this->service->job($request, $id);
        return view('frontEnd.jobs.apply', compact('job'));
    }

    /**
     * Apply load
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function jobApplyStore(JobApplicationRequest $request, $id)
    {
        if ($this->service->storeApplication($request, $id)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.job_application')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.job_application')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.job_application')]))->withInput();
    }


}
