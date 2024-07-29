<?php

namespace App\Http\Controllers\frontEnd;


use Illuminate\Http\Request;
use Modules\CMS\Entities\Blog;
use App\Services\FrontEndService;
use App\Http\Controllers\Controller;
use Modules\CMS\Entities\BlogDetails;
use App\Http\Requests\JobApplicationRequest;
use Modules\Settings\Entities\BlogCategory;
use App\Models\User;

class FrontEndController extends Controller
{
    private $service;
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

        $categories = BlogCategory::active()->pluck('name', 'id');
        $blogs = $this->getBlogDetailsWithFirstimage();

        $authors = User::with(['profile.image']) 
                ->where('role_id', 2)
                ->get();
        //$home = BlogDetails::where('type', BlogDetails::TYPE_HOME)->select('content')->first();

        return view('frontEnd.index', compact('categories','blogs','authors'));
    }

    public function getBlogDetailsWithFirstimage()
    {
        return Blog::with(['user:id,name', 'details', 'details.images'])
                ->get()
                ->map(function($blog){
                    $firstImage = $blog->details->flatMap(function($detail){
                        return $detail->images;
                    })->first();

                    return [
                        'title' => $blog->title,
                        'created_by' => $blog->user->name,
                        'created_at' => $blog->created_at,
                        'details' => $blog->details->map(function($detail){
                            return $detail->details;
                        })->first(),
                        'first_image' =>  $firstImage ?  $firstImage->path : null
                    ];
                });

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about(Request $request)
    {
        //$about = BlogDetails::where('type', BlogDetails::TYPE_ABOUT)->select('content')->first();
        //return view('frontEnd.about', compact('about'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact(Request $request)
    {
        $contact = BlogDetails::where('type', BlogDetails::TYPE_CONTACT)->select('content')->first();
        return view('frontEnd.contact', compact('contact'));
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
