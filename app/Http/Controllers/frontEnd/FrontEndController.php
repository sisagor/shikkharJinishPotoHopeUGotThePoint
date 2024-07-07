<?php

namespace App\Http\Controllers\frontEnd;

use Modules\Recruitment\Entities\Cms;
use App\Http\Requests\JobApplicationRequest;
use App\Services\FrontEndService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Recruitment\Entities\Job;
use Modules\Settings\Entities\JobCategory;

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

        $home = Cms::where('type', Cms::TYPE_HOME)->select('content')->first();
        return view('frontEnd.index', compact('home'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about(Request $request)
    {
        $about = Cms::where('type', Cms::TYPE_ABOUT)->select('content')->first();
        return view('frontEnd.about', compact('about'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact(Request $request)
    {
        $contact = Cms::where('type', Cms::TYPE_CONTACT)->select('content')->first();
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
