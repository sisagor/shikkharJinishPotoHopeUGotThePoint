<?php

namespace Modules\Recruitment\Repositories;

use App\Common\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Interview;
use Modules\Recruitment\Entities\Job;
use App\Repositories\EloquentRepository;
use Modules\Recruitment\Entities\JobApplication;
use Modules\Settings\Entities\JobCategory;


class JobRepository extends EloquentRepository implements JobRepositoryInterface
{
    public $model;

    public function __construct(Job $branch)
    {
        $this->model = $branch;
    }

    /*Get all branches*/
    public function jobs(Request $request)
    {
        $query =  $this->model->companyScope()->with('category:id,name');
        return (new Filter($request, $query))->commonScopeFilter(['com_id' => 'com_id', 'branch_id' => 'branch_id'])->execute();

    }

    /*Store Branch*/
    public function store(Request $request): bool
    {
        try {

            $this->model->create([
                'category_id' => $request->get('category_id'),
                'position' => $request->get('position'),
                'vacancy' => $request->get('vacancy'),
                'experience' => $request->get('experience'),
                'job_location' => $request->get('job_location'),
                'salary_rang' => $request->get('salary_rang'),
                'expire_date' => $request->get('expire_date'),
                'details' => json_encode($request->get('details')),
                'requirements' => json_encode($request->get('requirements')),
                'status' => Job::STATUS_OPEN,
            ]);

        } catch (\Exception $e) {

            Log::error("job create failed");
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
                'category_id' => $request->get('category_id'),
                'position' => $request->get('position'),
                'vacancy' => $request->get('vacancy'),
                'job_location' => $request->get('job_location'),
                'salary_rang' => $request->get('salary_rang'),
                'experience' => $request->get('experience'),
                'expire_date' => $request->get('expire_date'),
                'details' => json_encode($request->get('details')),
                'requirements' => json_encode($request->get('requirements')),
                'status' => $request->get('status'),
            ]);

        } catch (\Exception $e) {

            Log::error("Job update failed");
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


    public function jobCategories()
    {
        return JobCategory::active()->get();

    }
}
