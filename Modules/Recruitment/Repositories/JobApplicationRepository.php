<?php

namespace Modules\Recruitment\Repositories;

use App\Common\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\JobInterview;
use Modules\Recruitment\Entities\Job;
use App\Repositories\EloquentRepository;
use Modules\Recruitment\Entities\JobApplication;
use Modules\Settings\Entities\JobCategory;


class JobApplicationRepository extends EloquentRepository implements JobApplicationRepositoryInterface
{
    public $model;

    public function __construct(JobApplication $model)
    {
        $this->model = $model;
    }


    /*Return job applications */
    public function index(Request $request)
    {
        $query =  JobApplication::where('status', '!=', JobApplication::STATUS_REJECTED)
            ->with('job:id,position');
        return (new Filter($request, $query))
            ->statusFilter(['status' => 'status'])
            ->execute();

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



    /*Update Job Application*/
    public function update(Request $request, $model): bool
    {
        try {

            $model->update([
                'status' => $request->get('status'),
            ]);

        } catch (\Exception $e) {

            Log::error("Job application update failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }


    //JOb Offers
    /*offerAble jobs*/
    public function offerAbleJobs(Request $request)
    {
        $query =  $this->model->companyScope()
            ->where('status')
            ->with('category:id,name')
            ->with(['application' => function($application){
                $application->where('status', JobApplication::STATUS_INTERVIEW)
                    ->select('id', 'name', 'status');
            }])
            ->with(['interview' => function($interview){
                $interview->where('status', JobInterview::STATUS_PASS)
                    ->select('id', 'status');
            }]);

        return (new Filter($request, $query))->commonScopeFilter(['com_id' => 'com_id', 'branch_id' => 'branch_id'])->execute();

    }

}
