<?php

namespace Modules\Notification\Http\Controllers;

use App\Models\RootModel;
use Tzsk\Sms\Facades\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\Employee\Entities\Employee;
use Yajra\DataTables\Facades\DataTables;
use Modules\Notification\Entities\SmsLog;
use Modules\Notification\Entities\EmailLog;
use Illuminate\Contracts\Support\Renderable;
use Modules\Notification\Http\Requests\SmsCreateRequest;


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

        $data = EmailLog::join('employees', 'employees.id', 'email_log.employee_id')
            ->select(
                'email_log.*',
                'employees.employee_index',
                'employees.name as employee_name',
            );

        return DataTables::of($data)
            ->addIndexColumn()
            //->setTotalRecords($this->employeeCount('employees', \request()))
            ->editColumn('status', function ($row) {
                return get_sms_status($row->status);
            })
            ->addColumn('action', function ($row) {
                return view_button('notification.email.view', $row, 0) . delete_button('notification.email.delete', $row->id);
            })
            ->addColumn('body', function ($row) {
                return substr(json_decode($row->body), 0, 500);
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
        set_action('sms.sms.store');

        return view('notification::sms.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('notification::show');
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

        $email = [];

        return view('notification::email.createSchedule', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
