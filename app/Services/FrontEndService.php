<?php

namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Recruitment\Entities\Job;
use Modules\Recruitment\Entities\JobApplication;


class FrontEndService
{

    public function jobs(Request $request)
    {
        return Job::where('status', Job::STATUS_OPEN)->paginate(config('app.pagination'));
    }

    public function job(Request $request, $id)
    {
        return Job::where('status', Job::STATUS_OPEN)->where('id', $id)->first();
    }

    public function storeApplication(Request $request, $id): bool
    {
        try
        {
            $store = JobApplication::create([
                'job_id' => $id,
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'cover_later' => json_encode($request->get('cover_later')),
                'expected_salary' => $request->get('expected_salary'),
            ]);

            if ($request->hasFile('resume')){
                $store->saveDocument($request->file('resume'), 'resume', 1);
            }

        }
        catch (\Exception $e)
        {
            Log::error("job application error");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }

}
