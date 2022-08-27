<?php

namespace Modules\Notification\Http\Controllers;

use App\Models\RootModel;
use Modules\Notification\Entities\ScheduleEmailSms;
use Modules\Notification\Http\Requests\ScheduleSmsCreateRequest;
use Tzsk\Sms\Facades\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\Employee\Entities\Employee;
use Yajra\DataTables\Facades\DataTables;
use Modules\Notification\Entities\SmsLog;
use Illuminate\Contracts\Support\Renderable;
use Modules\Notification\Http\Requests\SmsCreateRequest;


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

        $data = SmsLog::join('employees', 'employees.id', 'sms_log.employee_id')
            ->select(
                'sms_log.*',
                'employees.employee_index',
                'employees.name as employee_name',
                'employees.phone',
            );

        return DataTables::of($data)
            ->addIndexColumn()
            //->setTotalRecords($this->employeeCount('employees', \request()))
            ->editColumn('status', function ($row) {
                return get_sms_status($row->status);
            })
            ->addColumn('action', function ($row) {
                return view_button('notification.sms.view', $row, 0) . delete_button('notification.sms.delete', $row->id);
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
            $employees = (!empty($employeePost) ? $employees->whereIn('id', array_values($employees)) : $employees)->get();

            foreach ($employees as $item) {

                str_replace('+', '', $item->phone);

                if (strlen($item->phone) < 11) {
                    Session::flash('warning', 'Phone number is not valid');
                    continue;
                }

                $send = Sms::send($message, function ($sms) use($item) {
                    $sms->to($item->phone);
                });


                if ($send) {

                    SmsLog::create([
                        'com_id' => com_id(),
                        'branch_id' => branch_id(),
                        'employee_id' => $item->id,
                        'sms' => $message,
                        'status' => 1,
                        'created_by' => Auth::id(),
                    ]);

                    return redirect()->back()->with('success', trans('msg.sent_success', ['model' => trans('model.sms')]));
                }
            };
        }
        catch (\Exception $exception){
            //dd($exception);

            Log::error("sms error");
            Log::error($exception->getMessage());
        }

        return redirect()->back()->with('error', trans('msg.sent_failed', ['model' => trans('model.sms')]));
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
            'delivery_time' => $request->get('delivery_time'),
            'delivery_type' => $request->get('delivery_type'),
            'details' => json_encode(['numbers' => $request->get('numbers'), 'body' => $request->get('body')]),
        ]);

        if($save)
        {
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.schedule_sms')]));
        }
        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.schedule_sms')]));
    }


}
