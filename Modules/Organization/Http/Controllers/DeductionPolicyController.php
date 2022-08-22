<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Organization\Entities\DeductionPolicy;
use Modules\Organization\Http\Requests\DeductionCreateRequest;
use Modules\Organization\Repositories\DeductionPolicyRepositoryInterface;


class DeductionPolicyController extends Controller
{
    //Repository
    private $repo;

    public function __construct(DeductionPolicyRepositoryInterface $deductionPolicyRepository)
    {
        $this->repo = $deductionPolicyRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(! $request->ajax()){
            return view('organization::deductionPolicy.index');
        }

        $data = $this->repo->all();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('deduction_amount', function ($row) {
                    return ($row->is_percent ? $row->deduction_amount.'%' : get_formatted_currency($row->deduction_amount, 2 ));
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('organization.deductionPolicy.edit', $row) . trash_button('organization.deductionPolicy.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('deduction_amount', function ($row) {
                    return ($row->is_percent ? $row->deduction_amount.'%' : get_formatted_currency($row->deduction_amount, 2 ));
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('organization.deductionPolicy.restore', $row) . delete_button('organization.deductionPolicy.delete', $row);
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
        set_action('organization.deductionPolicy.store');
        set_action_title('new_deduction_policy');
        $policy = [];
        return view('organization::deductionPolicy.newEdit', compact('policy'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(DeductionCreateRequest $request)
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.deduction_policy')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.deduction_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.deduction_policy')]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(DeductionPolicy $policy)
    {
        set_action('organization.deductionPolicy.update', $policy);
        set_action_title('edit_deduction_policy');

        return view('organization::deductionPolicy.newEdit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(DeductionCreateRequest $request, DeductionPolicy $policy)
    {
        if ($policy->update($request->all())) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.deduction_policy')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.deduction_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.deduction_policy')]));
    }

    /**
     * move to trash
     * @param int $id
     * @return Renderable
     */
    public function trash($policy) : RedirectResponse
    {
        if ($this->repo->trash($policy)) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.deduction_policy')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.deduction_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.deduction_policy')]));

    }


    /**
     * Restore from trash
     * @param int $id
     * @return Renderable
     */
    public function restore($policy) : RedirectResponse
    {
        if ($this->repo->restore($policy)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.deduction_policy')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.deduction_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.deduction_policy')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($policy) : RedirectResponse
    {
        if ($this->repo->destroyTrash($policy)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.deduction_policy')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.deduction_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.deduction_policy')]));
    }

}
