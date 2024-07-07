<?php

namespace Modules\Notification\Http\Controllers;

use Carbon\Carbon;
use App\Models\RootModel;
use Tzsk\Sms\Facades\Sms;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\Employee\Entities\Employee;
use Yajra\DataTables\Facades\DataTables;
use Modules\Notification\Entities\SmsLog;
use Illuminate\Contracts\Support\Renderable;
use Modules\Notification\Jobs\SmsNotificationJob;
use Modules\Notification\Entities\ScheduleEmailSms;
use Modules\Notification\Http\Requests\SmsCreateRequest;
use Modules\Notification\Http\Requests\ScheduleSmsCreateRequest;


class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('notification::sms.index');
        }

        $data = SmsLog::select(SmsLog::$fecth);

        return DataTables::of($data)
            ->addIndexColumn()
            //->setTotalRecords($this->employeeCount('employees', \request()))
            ->editColumn('status', function ($row) {
                return get_sms_status($row->status);
            })
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('Y-m-d h:i A');
            })
            ->addColumn('action', function ($row) {
                return delete_button('notification.sms.delete', $row->id);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);

    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action_title('send_new_sms');
        set_action('notification.sms.store');
        set_action_button('Send Sms');

        return view('notification::sms.create');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(SmsCreateRequest $request)
    {
        $department = $request->get('department');
        $employeePost = $request->get('employees');
        $message = $request->get('sms');


        if (\config('sms_gateway.status') == 1)
        {
            //dd(config('sms_gateway.driver'));
            Config::set('sms.default', config('sms_gateway.driver'));
            Config::set('sms.drivers.'.config('sms_gateway.driver'), json_decode(config('sms_gateway.details'), true));
        }
        else
        {
            return redirect()->back()->with('error', trans('msg.sms_gateway_not_found', ['model' => trans('model.sms')]));
        }

        try {

            $employees = Employee::where('status', RootModel::STATUS_ACTIVE)->select('id', 'phone');
            $employees = (! empty($departments) ? $employees->where('department_id', $department) : $employees);
            $employees = (! empty($employeePost) ? $employees->whereIn('id', array_values($employeePost)) : $employees)->pluck('phone')->toArray();

            //Send sms via SmsNotification Job;
            dispatch(new SmsNotificationJob($employees, $message))->delay(Carbon::now()->addMinute());

        }
        catch (\Exception $exception){
            //dd($exception);
            Log::error("sms error");
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', trans('msg.sent_failed', ['model' => trans('model.sms')]));
        }
        return redirect()->back()->with('success', trans('msg.sent_success', ['model' => trans('model.sms')]));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createScheduleSms()
    {
        set_action_title('schedule_sms');
        set_action('notification.sms.schedule.store');
        $sms = ScheduleEmailSms::where('type', ScheduleEmailSms::TYPE_SMS)->first();
        //set_action_button('Save');

        return view('notification::sms.createSchedule', compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     * @return RedirectResponse
     */
    public function storeScheduleSms(ScheduleSmsCreateRequest $request)
    {
        $save = ScheduleEmailSms::updateOrCreate(
            [
                'type' => ScheduleEmailSms::TYPE_SMS
            ],[
            'type' => ScheduleEmailSms::TYPE_SMS,
            'delivery_time' => Carbon::parse($request->get('delivery_time'))->format('H:i:s'),
            'delivery_type' => $request->get('delivery_type'),
            'details' => json_encode(['numbers' => $request->get('numbers'), 'body' => $request->get('body')]),
        ]);

        if($save)
        {
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.schedule_sms')]));
        }
        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.schedule_sms')]));
    }


    /**
     * Show the form for creating a new resource.
     * @return RedirectResponse
     */
    public function destroy(SmsLog $sms) : RedirectResponse
    {
        if($sms->forceDelete())
        {
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.sms')]));
        }
        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.sms')]));
    }




}
