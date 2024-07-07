<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Organization\Entities\LeavePolicy;
use Modules\Organization\Http\Requests\LeavePolicyCreateRequest;
use Modules\Organization\Repositories\LeavePolicyRepositoryInterface;


class LeavePolicyController extends Controller
{
    private $repo;

    public function __construct(LeavePolicyRepositoryInterface $leavePolicyRepository)
    {
        $this->repo = $leavePolicyRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(! $request->ajax()){
            return view('organization::leavePolicy.index');
        }

        $data = $this->repo->all();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('type', function ($row) {
                    $typo = '';
                    $types = json_decode($row->type_id, true);

                    foreach($types as $key =>  $type){
                        $typo .= $type['name']." : ". $type['days'] . ((count($types) !== $key+1) ? ", " : null);
                    }
                    return $typo;
                })
                ->editColumn('apply_at', function ($row) {
                    return leave_policy_apply_at($row->apply_at);
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('organization.leavePolicy.edit', $row) . trash_button('organization.leavePolicy.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }


        if ($request->get('type') == "trash"){
            $trash = $data->onlyTrashed();

            return DataTables::of($trash)
                ->addIndexColumn()
                ->editColumn('type', function ($row) {
                    $typo = '';
                    $types = json_decode($row->type_id, true);
                    foreach($types as $key =>  $type){
                        $typo .= $type['name']." : ". $type['days'] . ((count($types) !== $key+1) ? ", " : null);
                    }
                    return $typo;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('organization.leavePolicy.restore', $row) . delete_button('organization.leavePolicy.delete', $row);
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
        set_action('organization.policy.store');
        set_action_title('new_leave_policy');
        $policy = [];
        return view('organization::leavePolicy.newEdit', compact('policy'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(LeavePolicyCreateRequest $request)
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.leave_policy')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.deduction_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.leave_policy')]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(LeavePolicy $policy)
    {
        set_action('organization.leavePolicy.update', $policy);
        set_action_title('edit_leave_policy');

        return view('organization::leavePolicy.newEdit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(LeavePolicyCreateRequest $request, LeavePolicy $policy)
    {
        if ($policy->update($request->all())) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.leave_policy')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.leave_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.leave_policy')]));
    }

    /**
     * maove to trash
     * @param int $id
     * @return Renderable
     */
    public function trash($policy)
    {
        if ( $this->repo->trash($policy)) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.leave_policy')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.leave_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.leave_policy')]));
    }


    /**
     * Restore from trash
     * @param int $id
     * @return Renderable
     */
    public function restore($policy)
    {
        if ( $this->repo->restore($policy)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.leave_policy')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.leave_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.leave_policy')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($policy)
    {
        if ($this->repo->destroyTrash($policy)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.leave_policy')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.leave_policy')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.leave_policy')]));
    }


}
