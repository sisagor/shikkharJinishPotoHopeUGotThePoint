<?php

namespace App\Http\Controllers\Api\Attendance;


use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PunchLogResource;
use App\Http\Resources\AttendanceResource;
use Modules\Timesheet\Entities\Attendance;
use App\Http\Requests\Api\NewPunchRequest;
use App\Http\Controllers\Api\BaseController;
use Modules\Timesheet\Entities\AttendanceLog;


class AttendanceController extends BaseController
{

    //attendances
    public function index(Request $request)
    {
        try {

            $data = Attendance::where('employee_id', Auth::user()->employee_id);
            //If search not found default return current month data;
            $data = ($request->has('month') ?  $data->whereRaw("DATE_FORMAT(attendance_date, '%Y-%m') = ?", [$request->get('month')]) : $data);
            $data = ($request->has('status') ?  $data->where("status", $request->get('status')) : $data);

            $data = $data->orderBy('id', 'desc')->get();

            return AttendanceResource::collection($data);

        }
        catch (\Exception $exception){
            return $this->handleError(get_exception_message($exception), 'failed');
        }

    }



    //Punch logs;
    public function punchLog(Request $request)
    {
        try {

            $data = AttendanceLog::where('employee_id', Auth::user()->employee_id)
                ->whereRaw("DATE_FORMAT(punch_time, '%Y-%m') = ?", [Carbon::now()->format('Y-m')])
                ->orderBy('id', 'desc')
                ->get();

            return PunchLogResource::collection($data);

        }
        catch (\Exception $exception){
            return $this->handleError(get_exception_message($exception), 'failed');
        }

    }


    //Punch logs;
    public function newPunch(NewPunchRequest $request)
    {
        try {

            $employeeId = Auth::user()->employee_id;

            $request = call_user_func('array_merge', $request->all(), ['employee_id' => $employeeId]);

            unset($request['token']);

            AttendanceLog::create($request);

            return $this->handleResponse('Punch successful.', 'success');

        }
        catch (\Exception $exception){
            return $this->handleError(get_exception_message($exception), 'failed');
        }

    }



}
