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


class GeneratorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('frontEnd.generator.generator4CrosswordDefault');
    }

}
