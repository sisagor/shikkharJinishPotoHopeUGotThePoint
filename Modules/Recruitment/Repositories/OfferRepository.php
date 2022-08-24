<?php

namespace Modules\Recruitment\Repositories;

use App\Common\Filter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Job;
use App\Repositories\EloquentRepository;
use Modules\Recruitment\Entities\JobOffer;
use Illuminate\Database\Eloquent\Collection;
use Modules\Recruitment\Entities\JobInterview;
use Modules\Recruitment\Entities\JobApplication;


class OfferRepository extends EloquentRepository implements OfferRepositoryInterface
{
    public $model;

    public function __construct(JobOffer $branch)
    {
        $this->model = $branch;
    }

    /*Get all branches*/
    public function offers(Request $request)
    {
        $query = $this->model
            ->with('application:id,name')
            ->with('application.job:id,position');
        return (new Filter($request, $query))
            ->commonScopeFilter(['com_id' => 'com_id', 'branch_id' => 'branch_id'])
            ->execute();

    }

    /*Store Branch*/
    public function store(Request $request): bool
    {
        try {

            $this->model->create([
                'job_id' => $request->get('job_id'),
                'job_application_id' => $request->get('job_application_id'),
                'title' => $request->get('title'),
                'details' => json_encode($request->get('details')),
                'status' => JobOffer::STATUS_PENDING,
            ]);

        } catch (\Exception $e) {

            Log::error("Offer create failed");
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
                'title' => $request->get('title'),
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


    public function getJobs()
    {
        return Job::where('status', Job::STATUS_OPEN)->pluck('position', 'id');
    }


    /**
     * get candidate by job jobPosting id.
     * @return Collection
     */
    public function getApplicationCandidate(Request $request)
    {
        return JobApplication::query()
            ->join('job_interviews', 'job_interviews.job_application_id', 'job_applications.id')
            ->where('job_applications.job_id', $request->get('id'))
            ->where('job_applications.status', JobApplication::STATUS_INTERVIEW)
            ->where('job_interviews.status', JobInterview::STATUS_PASS)
            ->select('job_applications.id', 'job_applications.name as text')
            ->get();
    }



}
