<?php
namespace Modules\Recruitment\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Cms;
use Modules\Recruitment\Entities\Job;
use App\Repositories\EloquentRepository;


class CmsRepository extends EloquentRepository implements CmsRepositoryInterface
{
    public $model;

    public function __construct(Cms $branch)
    {
        $this->model = $branch;
    }

    /*Get all branches*/
    public function index(Request $request)
    {
        return $this->model->select('id', 'key', 'body');
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


    public function getJobs()
    {
        return Job::where('status', Job::STATUS_OPEN)->pluck('position', 'id');
    }


}
