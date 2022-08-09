<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Organization\Entities\Designation;
use Modules\Organization\Repositories\DesignationRepositoryInterface;



class DesignationController extends Controller
{
    protected $repo;

    public function __construct(DesignationRepositoryInterface $designation)
    {
        $this->repo = $designation;
    }

    /**
     * Designations
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(! $request->ajax()){
            return view('organization::designation.index');
        }

        $data = $this->repo->all();

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('department', function ($row) {
                    return ($row->department ? $row->department->name : null);
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button($row, 'modal') . trash_button($row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){
            $trash = $data->onlyTrashed();

            return DataTables::of($trash)
                ->addIndexColumn()
                ->editColumn('department', function ($row) {
                    return ($row->department ? $row->department->name : null);
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
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
    public function create(): Renderable
    {
        set_action('organization.designation.store');
        set_action_title('new_designation');
        $designation = [];
        return view('organization::designation.newEdit', compact('designation'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($this->repo->store($request)) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.designation')]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Designation $designation): Renderable
    {
        set_action('organization.designation.update', $designation);
        set_action_title('edit_designation');

        return view('organization::designation.newEdit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, Designation $designation): RedirectResponse
    {
        if ($this->repo->update($request, $designation)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.designation')]));
    }

    /**
     * Trash
     * @param int $id
     * @return RedirectResponse
     */
    public function trash($designation): RedirectResponse
    {
        if ($this->repo->trash($designation)) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.designation')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($designation): RedirectResponse
    {
        if ($this->repo->destroyTrash($designation)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.designation')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($designation): RedirectResponse
    {
        if ($this->repo->restore($designation)) {
            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.designation')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.designation')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.designation')]));
    }


    /**
     * Return JsonResponse
     */
    public function getDesignations(Request $request): \Illuminate\Http\JsonResponse
    {
        $designations = Designation::where('department_id', $request->get('id'))
            ->select('id', 'name as text')->get()->toArray();

        if ($designations) {
            return response()->json($designations);
        }

        return response()->json(['id' => '0', 'text' => 'No designation found']);
    }
}
