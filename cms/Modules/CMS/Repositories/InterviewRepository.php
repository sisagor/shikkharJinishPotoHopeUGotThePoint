<?php

namespace Modules\CMS\Repositories;

use App\Common\Filter;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\JobName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;
use Modules\CMS\Entities\JobInterview;
use Modules\CMS\Entities\Blog;
use Modules\CMS\Entities\JobApplication;


class InterviewRepository extends EloquentRepository implements InterviewRepositoryInterface
{
    public $model;

    public function __construct(JobInterview $branch)
    {
        $this->model = $branch;
    }

    /*Get all branches*/
    public function index(Request $request)
    {
        $query =  $this->model
            ->with('application:id,name')
            ->with('application.job:id,position');
        return (new Filter($request, $query))
            ->statusFilter(['status' => 'status'])
            ->execute();

    }


    /*Store Branch*/
    public function store(Request $request): bool
    {
        try {

            $this->model->create([
                'job_id' => $request->get('job_id'),
                'job_application_id' => $request->get('job_application_id'),
                'interview_date' => $request->get('interview_date'),
                'interview_time' => $request->get('interview_time'),
                'address' => $request->get('address'),
                'interviewers' => json_encode($request->get('interviewers')),
                'details' => json_encode($request->get('details')),
                'status' => JobInterview::STATUS_SCHEDULED,
            ]);

        } catch (\Exception $e) {

            Log::error("Interview create failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*Update Branch*/
    public function update(Request $request, $model): bool
    {
        try {

            $model->update([
                'job_id' => $request->get('job_id'),
                'job_application_id' => $request->get('job_application_id'),
                'interview_date' => $request->get('interview_date'),
                'interview_time' => $request->get('interview_time'),
                'address' => $request->get('address'),
                'interviewers' => json_encode($request->get('interviewers')),
                'details' => json_encode($request->get('details')),
                'status' => $request->get('status'),
            ]);

        } catch (\Exception $e) {

            Log::error("Interview update failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    /*Delete branch */
    public function destroy($model): bool
    {
        try {

            DB::beginTransaction();

            $model->user->forceDelete();
            $model->forceDelete();

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Delete Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    public function getJobs($status = Blog::STATUS_OPEN)
    {
        return Blog::where('status', $status)->pluck('position', 'id');
    }


}
