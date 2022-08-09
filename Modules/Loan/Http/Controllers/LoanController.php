<?php

namespace Modules\Loan\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Loan\Entities\Loan;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Loan\Http\Requests\LoanCreateRequest;
use Modules\Loan\Repositories\LoanRepositoryInterface;


class LoanController extends Controller
{
    private $repo;

    public function __construct(LoanRepositoryInterface $loanRepository)
    {
        $this->repo = $loanRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function pending(Request $request)
    {
        if (! $request->ajax()){
            return view('loan::pending');
        }

        $data = $this->repo->pending($request);

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return edit_button($row, "modal") . trash_button($row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return restore_button($row) . delete_button($row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action('loans.loan.store');
        set_action_title('new_loan');
        $loan = [];

        return view('loan::newEdit', compact('loan'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(LoanCreateRequest $request) : RedirectResponse
    {
        if ($this->repo->store($request)) {
            #send activity notification
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.loan')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.loan')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.loan')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('loan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Loan $loan)
    {
        set_action('loans.loan.update', $loan);
        set_action_title('loan_edit');

        return view('loan::newEdit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(LoanCreateRequest $request, Loan $loan)
    {
        if ($this->repo->update($request, $loan)) {
            #send activity notification
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.loan')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.loan')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.loan')]));

    }

    /**
     * soft Delete the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(Loan $loan): RedirectResponse
    {
        if ($loan->status !== Loan::LOAN_STATUS_RELEASED && $loan->delete()) {
            #send activity notification
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.loan')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.loan')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.loan')]));
    }


    /**
     * Restore the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($loan): RedirectResponse
    {

        if ($this->repo->findTrash($loan)->restore()) {
            #send activity notification
            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.loan')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.loan')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.loan')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Loan $loan) : RedirectResponse
    {
        if ($loan->status !== Loan::LOAN_STATUS_RELEASED && $loan->forceDelete()) {
            #send activity notification
            sendActivityNotification(trans('msg.noty.delete', ['model' => trans('model.loan')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.loan')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.loan')]));
    }
}
