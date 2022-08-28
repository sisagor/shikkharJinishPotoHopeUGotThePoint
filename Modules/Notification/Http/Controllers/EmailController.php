<?php

namespace Modules\Notification\Http\Controllers;

use Carbon\Carbon;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Employee\Entities\Employee;
use Yajra\DataTables\Facades\DataTables;
use Modules\Notification\Entities\EmailLog;
use Illuminate\Contracts\Support\Renderable;
use Modules\Notification\Jobs\NotificationJob;
use Modules\Notification\Entities\ScheduleEmailSms;
use Modules\Notification\Http\Requests\EmailCreateRequest;
use Modules\Notification\Notifications\SendEmailNotification;
use Modules\Notification\Http\Requests\ScheduleEmailCreateRequest;



class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return //Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('notification::email.index');
        }

        $data = EmailLog::select(EmailLog::$fecth);

        return DataTables::of($data)
            ->addIndexColumn()
            //->setTotalRecords($this->employeeCount('employees', \request()))
            ->editColumn('status', function ($row) {
                return get_email_status($row->status);
            })
            ->addColumn('action', function ($row) {
                return view_button('notification.email.view', $row) . delete_button('notification.email.delete', $row->id);
            })
            ->addColumn('body', function ($row) {
                return substr(json_decode($row->body), 0, 500);
            })
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('Y-m-d h:i A');
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
        set_action('notification.email.store');

        return view('notification::email.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(EmailCreateRequest $request)
    {
        $department = $request->get('department');
        $employeePost = $request->get('employees');
        $subject = $request->get('subject');
        $body = $request->get('body');

        try {

            $employees = Employee::where('status', RootModel::STATUS_ACTIVE);
            $employees = (! empty($departments) ? $employees->where('department_id', $department) : $employees);
            $employees = (! empty($employeePost) ? $employees->whereIn('id', array_values($employees)) : $employees)->pluck('email');

            //send email
            dispatch(new NotificationJob(SendEmailNotification::class, $employees, $subject, $body))->delay(Carbon::now()->addMinute());

            return redirect()->back()->with('success', trans('msg.sent_success', ['model' => trans('model.email')]));
        }
        catch (\Exception $exception){
            //dd($exception);
            Log::error("sms error");
            Log::error($exception->getMessage());
        }

        return redirect()->back()->with('error', trans('msg.sent_failed', ['model' => trans('model.email')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(EmailLog $email)
    {
        return view('notification::email.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function createScheduleEmail()
    {
        set_action('notification.email.schedule.store');
        set_action_title('schedule_email');

        $email = ScheduleEmailSms::where('type', ScheduleEmailSms::TYPE_EMAIL)->first();

        return view('notification::email.createSchedule', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function storeScheduleEmail(ScheduleEmailCreateRequest $request)
    {
        $save = ScheduleEmailSms::updateOrCreate(
            [
                'type' => ScheduleEmailSms::TYPE_EMAIL
            ],[
            'type' => ScheduleEmailSms::TYPE_EMAIL,
            'delivery_time' => Carbon::parse($request->get('delivery_time'))->format('H:i:s'),
            'delivery_type' => $request->get('delivery_type'),
            'details' => json_encode([
                'emails' => $request->get('emails'),
                'subject' => $request->get('subject'),
                'body' => $request->get('body')
            ]),
        ]);

        if($save)
        {
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.schedule_email')]));
        }
        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.schedule_email')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(EmailLog $email)
    {
        if ($email->forceDelete()){
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.email')]));
        }
        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.email')]));
    }
}
