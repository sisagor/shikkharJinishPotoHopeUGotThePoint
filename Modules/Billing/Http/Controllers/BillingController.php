<?php

namespace Modules\Billing\Http\Controllers;

use App\Models\User;
use App\Models\RootModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Billing\Entities\Billing;
use Modules\Billing\Entities\Project;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Billing\Http\Requests\BillingCreateRequest;
use Modules\Billing\Repositories\BillingRepositoryInterface;


class BillingController extends Controller
{
    protected $repo;

    public function __construct(BillingRepositoryInterface $billingRepository)
    {
        $this->repo = $billingRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function pending(Request $request)
    {
       // dd($this->repo->pendingBills($request)->get());

        if (! $request->ajax()){
            return view('billing::pending');
        }

        $data = $this->repo->pendingBills($request);

        if ($request->get('type') == RootModel::DATA_ACTIVE)
        {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('mobile_bil', function ($row) {
                    return get_formatted_currency($row->mobile_bill, 2);
                })
                ->editColumn('other_bill', function ($row) {
                    return get_formatted_currency($row->other_bill, 2);
                })
                ->editColumn('allowance', function ($row) {
                    return get_formatted_currency($row->allowance, 2);
                })
                ->editColumn('total', function ($row) {
                    return get_formatted_currency($row->total, 2);
                })
                ->editColumn('status', function ($row) {
                    return get_billing_status($row->status);
                })
                ->editColumn('attachment', function ($row) {
                    if ($row->document) {
                        return '<a href="' . get_file_url(optional($row->document)->path) . '" target="_blank"> ' . $row->document->name . '</a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return edit_button('billing.bill.edit', $row, 0) . trash_button('billing.bill.trash', $row);
                })
                ->rawColumns(['status', 'action', 'attachment'])
                ->make(true);
        }

        if ($request->get('type') == RootModel::DATA_TRASH)
        {
            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('mobile_bil', function ($row) {
                    return get_formatted_currency($row->mobile_bill, 2);
                })
                ->editColumn('other_bill', function ($row) {
                    return get_formatted_currency($row->other_bill, 2);
                })
                ->editColumn('allowance', function ($row) {
                    return get_formatted_currency($row->allowance, 2);
                })
                ->editColumn('total', function ($row) {
                    return get_formatted_currency($row->total, 2);
                })
                ->editColumn('status', function ($row) {
                    return get_billing_status($row->status);
                })
                ->editColumn('attachment', function ($row) {
                    if ($row->document) {
                        return '<a href="' . get_file_url(optional($row->document)->path) . '" target="_blank"> ' . $row->document->name . '</a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return restore_button('billing.bill.restore', $row) . delete_button('billing.bill.delete', $row);
                })
                ->rawColumns(['status', 'action', 'attachment'])
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function approved(Request $request)
    {
        if (! $request->ajax()){
            return view('billing::approved');
        }

        $data = $this->repo->approvedBills($request);

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('mobile_bil', function ($row) {
            return get_formatted_currency($row->mobile_bill, 2);
        })
        ->editColumn('other_bill', function ($row) {
            return get_formatted_currency($row->other_bill, 2);
        })
        ->editColumn('allowance', function ($row) {
            return get_formatted_currency($row->allowance, 2);
        })
        ->editColumn('total', function ($row) {
            return get_formatted_currency($row->total, 2);
        })
        ->editColumn('status', function ($row) {
            return get_billing_status($row->status);
        })
        ->editColumn('attachment', function ($row) {
            if ($row->document) {
                return '<a href="' . get_file_url(optional($row->document)->path) . '" target="_blank"> ' . $row->document->name . '</a>';
            }
        })
        ->addColumn('action', function ($row) {
            //return edit_button('billing.bill.edit', $row, 0) . trash_button('billing.bill.trash', $row);
            return view_button('billing.bill.view', $row);
        })
        ->rawColumns(['status', 'action', 'attachment'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action('billing.bill.store');
        set_action_title('new_bill');

        $projects = Project::active()->get();
        $managers = User::whereNotNull('manager')->where('status', RootModel::STATUS_ACTIVE)->pluck('name', 'id');
        $bill = [];
        return view('billing::newEdit', compact('projects', 'managers', 'bill'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(BillingCreateRequest $request)
    {
        $store = $this->repo->store($request);

        if ($store) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.billing')]));
            return redirect()->route('billing.bill.pending')->with('success', trans('msg.create_success', ['model' => trans('model.billing')]));
        }

        return redirect()->route('billing.bill.pending')->with('error', trans('msg.create_failed', ['model' => trans('model.billing')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, Billing $bill)
    {
        set_action_title('view');
        $projects = Project::active()->get();
        $managers = User::where('manager', User::USER_MANAGER)->where('status', RootModel::STATUS_ACTIVE)->get();

        return view('billing::show', compact('bill', 'projects', 'managers'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Billing $bill)
    {
        set_action('billing.bill.update', $bill);
        set_action_title('edit_bill');

        $projects = Project::active()->get();
        $managers = User::whereNotNull('manager')->where('status', RootModel::STATUS_ACTIVE)->pluck('name', 'id');

        return view('billing::newEdit', compact('bill', 'projects', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, Billing $bill)
    {
        $update = $this->repo->update($request, $bill);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.billing')]));

            return redirect()->route('billing.bill.pending')->with('success', trans('msg.update_success', ['model' => trans('model.billing')]));
        }

        return redirect()->route('billing.bill.pending')->with('error', trans('msg.update_failed', ['model' => trans('model.billing')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(Billing $bill)
    {
        if ($bill->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.billing')]));
            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.billing')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.billing')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($id)
    {
        $project = Billing::onlyTrashed()->find($id)->restore();

        if ($project) {

            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.billing')]));
            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.billing')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.billing')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function delete($id)
    {  $project = Billing::onlyTrashed()->find($id)->forceDelete();

        if ($project) {

            sendActivityNotification(trans('msg.noty.delete', ['model' => trans('model.billing')]));
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.billing')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.billing')]));
    }


     /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse | JsonResponse
     */
    public function report(Request $request)
    {
         //dd($this->repo->report($request)->get());

        if (! $request->ajax()){
            return view('billing::report');
        }

        $data = $this->repo->report($request);


        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('mobile_bil', function ($row) {
                return number_format($row->mobile_bill, 2);
            })
            ->editColumn('other_bill', function ($row) {
                return number_format($row->other_bill, 2);
            })
            ->editColumn('allowance', function ($row) {
                return number_format($row->allowance, 2);
            })
            ->editColumn('total', function ($row) {
                return number_format($row->total, 2);
            })
            ->addColumn('totalDue', function ($row) {
                return number_format(($row->employee->bill_sum_loan_amount - $row->total), 2);
            })

            ->rawColumns(['status', 'action', 'attachment'])
            ->make(true);



    }




}
