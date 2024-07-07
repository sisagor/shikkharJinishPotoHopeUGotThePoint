<?php

namespace Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Recruitment\Entities\Job;
use Illuminate\Http\RedirectResponse;
use Modules\Recruitment\Entities\JobOffer;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Recruitment\Http\Requests\OfferCreateRequest;
use Modules\Recruitment\Repositories\OfferRepositoryInterface;


class OfferController extends Controller
{
    protected $repo;

    public function __construct(OfferRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }
    /**
     * section job posting
      */

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if (! $request->ajax()){
            return view('recruitment::offers.index');
        }

        $data = $this->repo->offers($request);

        if ($request->get('type') == "active"){

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('details', function ($row){
                    return substr(json_decode($row->details), 0, 500);
                })
                ->addColumn('action', function ($row) {
                    return edit_button('recruitment.offer.edit', $row) . trash_button('recruitment.offer.trash', $row);
                    /*return ($row->status == JobOffer::STATUS_PENDING)
                        ? edit_button('recruitment.offer.edit', $row) . trash_button('recruitment.offer.trash', $row)
                        : trash_button('recruitment.offer.trash', $row) ;*/
                })
                ->rawColumns(['action', 'details'])
                ->make(true);
        }

        if ($request->get('type') == "trash"){

            return DataTables::of($data->onlyTrashed())
                ->addIndexColumn()
                ->editColumn('cover_later', function ($row){
                    return substr(json_decode($row->details), 0, 500);
                })
                ->addColumn('action', function ($row) {
                    return restore_button('recruitment.offer.restore', $row) . delete_button('recruitment.offer.delete', $row);
                })
                ->rawColumns(['action', 'details'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        set_action_title('new_offer');
        set_action('recruitment.offer.store');
        $jobs = Job::where('status', Job::STATUS_OPEN)->pluck('position', 'id');

        $offer = [];
        //$jobCategory = $this->repo->jobCategories();
        return view('recruitment::offers.newEdit', compact('jobs', 'offer'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(OfferCreateRequest $request) : RedirectResponse
    {
        if ($this->repo->store($request)) {

            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Job $job): Renderable
    {
        return view('recruitment::offers.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JobOffer $offer): Renderable
    {
        set_action_title('edit_offer');
        set_action('recruitment.offer.update', $offer);
        $jobs = Job::where('status', Job::STATUS_OPEN)->pluck('position', 'id');
        return view('recruitment::offers.newEdit', compact('offer', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(OfferCreateRequest $request, JobOffer $offer) : RedirectResponse
    {
        if ($this->repo->update($request, $offer)) {

            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * soft delete the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function trash(Job $job) : RedirectResponse
    {
        if ($job->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($loan) : RedirectResponse
    {
        if ($this->repo->restore($loan)) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Job $job): RedirectResponse
    {
        if ($job->forceDelete()) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.job')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.job')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.job')]))->withInput();
    }

    /**
     * End section job posting
     * @return JsonResponse
     */

    public function getSelectedCandidate(Request $request): JsonResponse
    {
        if ($data = $this->repo->getApplicationCandidate($request)) {
            return response()->json($data);
        }

        return response()->json(['id' => '0', 'text' => 'No candidate found']);
    }
}
