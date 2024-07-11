<?php

namespace App\Http\Controllers;


use App\Models\SystemSetting;
use App\Services\ZKTService;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    private $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->service = new DashboardService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $dashboard = "dashboard";
       /* $zkt = new ZKTService('10.8.10.11');
        if ( $zkt->connect()){
            $zkt->enableDevice();
            $zkt->getAttendance();
            $zkt->clearAttendance();
            var_dump($zkt->getUser());
        }*/


        return is_employee() ? view('partials.dashboard.employee') : view('partials.dashboard.'.$dashboard);
    }


    public function notifications(Request $request)
    {
        $notifications = DatabaseNotification::with('notifiable:id,name')
            ->whereHas('notifiable', function ($user) {
                $user->where('id', user_id());
            })
            ->select('id', 'read_at', 'data', 'notifiable_type', 'notifiable_id', 'created_at')
            ->orderByRaw('-read_at ASC')
            ->orderBy('created_at', 'desc')
            ->paginate(config('system_settings.pagination'));

        return view('partials.notification.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $notification = DatabaseNotification::where('id', $request->get('id'))->first();

        $notification->markAsRead();
        return response()->json(['status' => 1, 'msg' => "notification mark as read"]);

    }


    /** if missed the form action */
    public function actionMissing()
    {
        return view('errors.actionMissing');
    }


    /*Dashboard chart Data*/
    public function salaries(Request $request)
    {
        $data = $this->service->getSalaries($request);

        return response()->json($data);
    }


    /*Dashboard Attendance average*/
    public function attendancesAverage(Request $request)
    {
        $data = $this->service->getAttendanceAverage($request);

        return response()->json($data);
    }


    /*Dashboard Today Attendance */
    public function todayAttendance(Request $request)
    {
        $data = $this->service->getTodayAttendances($request);
        return response()->json($data);
    }


    /*Dashboard chart Data*/
    public function holidays(Request $request)
    {
        $data = $this->service->getHolidays($request);

        return response()->json($data);
    }


    /*Leave Policy chart Data*/
    public function leavePolicy(Request $request)
    {
        $data = $this->service->getLeavePolicies($request);

        return response()->json($data);
    }


}
