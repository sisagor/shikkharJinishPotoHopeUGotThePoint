<?php

namespace Modules\SMS\Http\Controllers;

use App\Models\RootModel;
use Tzsk\Sms\Facades\Sms;
use Illuminate\Http\Request;
use Modules\SMS\Entities\SmsLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\Employee\Entities\Employee;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\SMS\Http\Requests\SmsCreateRequest;


class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('sms::sms.index');
        }

        $data = SmsLog::join('employees', 'employees.id', 'sms_log.employee_id')
            ->select(
                'sms_log.*',
                'employees.employee_index',
                DB::raw('CONCAT(`first_name`, " ", `last_name`) as employee_name'),
                'employees.phone',
            );

        return DataTables::of($data)
            ->addIndexColumn()
            //->setTotalRecords($this->employeeCount('employees', \request()))
            ->editColumn('status', function ($row) {
                return get_sms_status($row->status);
            })
            ->addColumn('action', function ($row) {
                return delete_button($row->id);
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

        return view('sms::sms.create');
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
        return view('sms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sms::edit');
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
