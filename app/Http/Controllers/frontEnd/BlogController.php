<?php

namespace App\Http\Controllers\frontEnd;


use App\Models\User;
use App\Models\SeoPage;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Modules\CMS\Entities\Blog;
use Modules\CMS\Entities\Book;
use App\Services\FrontEndService;
use App\Http\Controllers\Controller;
use Modules\CMS\Entities\BlogDetails;
use App\Http\Requests\JobApplicationRequest;
use Modules\Settings\Entities\BlogCategory;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class BlogController extends Controller
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

        $blogs = SeoPage::where('status', RootModel::STATUS_ACTIVE)->first();


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

}
