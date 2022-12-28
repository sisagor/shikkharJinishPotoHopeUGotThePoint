<?php

namespace Modules\Billing\Http\Controllers;

use App\Models\RootModel;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Billing\Entities\Project;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Billing\Http\Requests\ProjectCreateRequest;
use Modules\Billing\Http\Requests\ProjectUpdateRequest;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable | JsonResponse
     */
    public function index(Request $request)
    {

        if (! $request->ajax()){
            return view('billing::project.index');
        }

        $data = Project::select(Project::$fetch)->mine()->with('manager:id,name');

        if ($request->get('type') == RootModel::DATA_ACTIVE)
        {
            return DataTables::of($data)
                ->addIndexColumn()
             /*   ->editColumn('role', function ($row) {
                    return $row->user->role->name;
                })*/
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('billing.project.edit', $row) . trash_button('billing.project.trash', $row);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        if ($request->get('type') == RootModel::DATA_TRASH)
        {
            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
               /* ->editColumn('role', function ($row) {
                    return $row->user->role->name;
                })*/
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('billing.project.restore', $row) . delete_button('billing.project.delete', $row);
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
        set_action('billing.project.store');
        set_action_title('new_project');

        $project = [];
        $managers = User::where('manager', User::MANAGER)->get();

        return view('billing::project.newEdit', compact('project', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProjectCreateRequest $request)
    {
        $store = Project::create($request->validated());

        if ($store) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.project')]));
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.project')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.project')]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('billing::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Project $project)
    {
        set_action_title('edit_project');
        set_action('billing.project.update', $project);

        $managers = User::where('manager', User::MANAGER)->get();

        return view('billing::project.newEdit', compact('project', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        if ($project->update($request->validated())) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.project')]));
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.project')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.project')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(Project $project)
    {
        if ($project->delete()) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.project')]));
            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.project')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.project')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore($id)
    {
        $project = Project::onlyTrashed()->find($id);

        if ($project->restore()) {

            sendActivityNotification(trans('msg.noty.restore', ['model' => trans('model.project')]));
            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.project')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.project')]));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
        $project = Project::onlyTrashed()->find($id)->forceDelete();

        if ($project) {

            sendActivityNotification(trans('msg.noty.delete', ['model' => trans('model.project')]));
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.project')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.project')]));
    }
}
