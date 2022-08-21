<?php

namespace Modules\Settings\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\Holiday;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Http\Requests\HolidayCreateRequest;
use Yajra\DataTables\Facades\DataTables;


class HolidayController extends Controller
{

    private $model;

    public function __construct(Holiday $holiday)
    {
        $this->model = $holiday;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if (! $request->ajax()){
            return view('settings::holiday.index');
        }

        $holidays = Holiday::select(Holiday::$fetch);


        if ($request->get('year')) {
            $holidays->where('holiday_year', $request->get('year'));
        }
        if ($request->get('month')) {
            $holidays->where('holiday_month', $request->get('month'));
        }
        else {
            $holidays->where('holiday_year', date('Y'))->where('holiday_month', date('month'));
        }

        $holidays = $holidays->commonScope();

        return DataTables::of($holidays)
            ->addIndexColumn()
            //->setTotalRecords($this->employeeCount('employees', \request()))
            ->addColumn('action', function ($row) {
                return delete_button('componentSettings.holiday.delete',$row->id);
            })
            ->addColumn('status', function ($row) {
                return get_status($row->status);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        set_action('componentSettings.holiday.store');
        set_action_title('new_holiday');

        return view('settings::holiday.new');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(HolidayCreateRequest $request): RedirectResponse
    {

        $exist = Holiday::where('com_id', com_id())
            ->where(function ($item) use($request){
                $item->where('start_date', $request->get('start_date'))->orWhere('end_date', $request->get('start_date'));
            })
            ->where(function ($item) use($request){
                $item->where('start_date', $request->get('end_date'))->orWhere('end_date', $request->get('end_date'));
            })
            ->count();

        if ($exist){
            return redirect()->back()->with('error', 'Holiday Already exist!');
        }

        $periods = CarbonPeriod::create($request->get('start_date'), $request->get('end_date'))->toArray();

        $startNode = null;
        $months = [];
        $data = [];

        foreach ($periods as $key =>  $period)
        {
            //initiate start node;
            if ($key == 0)
            {
                $startNode = $periods[$key]->format('Y-m');
            }

            //differ month by month:
            if ($startNode === $period->format('Y-m'))
            {
                if (! in_array($period->format('Y-m'), $months))
                {
                    if (count($months) > 0  )
                    {
                        $startDate =  $period->startOfMonth()->format('Y-m-d');
                    }
                    else
                    {
                        $startDate = $request->get('start_date');
                    }

                    //Push Month
                    $months[] = $period->format('Y-m');

                    if (end($periods)->format('Y-m') == end($months))
                    {
                        $endDate = $request->get('end_date');
                    }
                    else
                    {
                        $endDate = $period->endOfMonth()->format('Y-m-d');
                    }

                    $data[] = [
                        'occasion' => $request->get('occasion'),
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'days' => (Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1),
                        'holiday_month' => $period->format('m'),
                        'holiday_year' => $period->format('Y'),
                        'status' => $request->get('status'),
                    ];

                }
            }

            if($startNode !== $period->format('Y-m'))
            {
                $startNode = $periods[$key]->format('Y-m');
            }
        }

        $store = 0;
        foreach ($data as $item){
            $store = $this->model->create($item);
        }

        if ($store) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.holiday')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.holiday')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.holiday')]));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Holiday $holiday)
    {

        if ($holiday->forceDelete()) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.holiday')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.holiday')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.holiday')]));
    }
}
