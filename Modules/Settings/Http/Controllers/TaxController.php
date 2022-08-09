<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Tax;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Http\Requests\TaxCreateRequest;


class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if(! $request->ajax()){
            return view('settings::taxes.index');
        }

        if ($request->get('type') == "active"){

            $data  = Tax::commonScope()->select(Tax::$fetch);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('eligible_amount', function ($row) {
                    return  get_formatted_currency($row->eligible_amount, 2);
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
            $trash = Tax::commonScope()->select(Tax::$fetch)->onlyTrashed();

            return DataTables::of($trash)
                ->addIndexColumn()
                ->editColumn('eligible_amount', function ($row) {
                    return  get_formatted_currency($row->eligible_amount, 2);
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
    public function create()
    {
        set_action('componentSettings.tax.store');
        set_action_title('new_tax');

        $tax = [];

        return view('settings::taxes.newEdit', compact('tax'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TaxCreateRequest $request)
    {
        $create = Tax::create($request->all());

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.tax')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.tax')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.tax')]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Tax $tax)
    {
        set_action('componentSettings.tax.update', $tax);
        set_action_title('edit_tax');

        return view('settings::taxes.newEdit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TaxCreateRequest $request, Tax $tax)
    {
        $update = $tax->update($request->all());

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.tax')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.tax')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.tax')]));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($tax)
    {
        if (Tax::onlyTrashed()->find($tax)->forceDelete()) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.tax')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.tax')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.tax')]));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function trash(Tax $tax)
    {
        if ($tax->delete()) {

            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.tax')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.tax')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.tax')]));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function restore($tax)
    {
        if (Tax::onlyTrashed()->find($tax)->restore()) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.tax')]));

            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.tax')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.tax')]));
    }

}
