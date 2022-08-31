<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Recruitment\Entities\Job;
use Modules\Recruitment\Entities\Cms;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Recruitment\Http\Requests\JobCreateRequest;
use Modules\Recruitment\Http\Requests\CmsCreateRequest;
use Modules\Recruitment\Repositories\CmsRepositoryInterface;


class CMSController extends Controller
{
    protected $repo;

    public function __construct(CmsRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }

    /**
     * section job posting
      */

    /**
     * Display a listing of the resource.
     * @return //Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('recruitment::cms.index');
        }

        $data = $this->repo->index($request);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('content', function ($row){
                return substr(json_decode($row->content), 0, 500);
            })
            ->editColumn('status', function ($row) {
                return get_status($row->status);
            })
            ->addColumn('action', function ($row) {
                return view_button('recruitment.cms.view', $row). edit_button('recruitment.cms.edit', $row) . delete_button('recruitment.cms.delete', $row);
            })
            ->rawColumns(['action', 'content', 'status'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        set_action_title('new_content');
        set_action('recruitment.cms.store');
        $cms = [];

        return view('recruitment::cms.newEdit', compact('cms'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(CmsCreateRequest $request)
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.cms')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.cms')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.cms')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Cms $cms)
    {
        return view('recruitment::cms.show', compact('cms'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Cms $cms)
    {
        set_action_title('edit_cms');
        set_action('recruitment.cms.update', $cms);
        return view('recruitment::cms.newEdit', compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CmsCreateRequest $request, Cms $cms)
    {
        if ($this->repo->update($request, $cms)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.cms')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.cms')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.cms')]))->withInput();
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Cms $cms)
    {
        if ($cms->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.cms')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.cms')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.cms')]))->withInput();
    }

    /**
     * End section job posting
     */
}
