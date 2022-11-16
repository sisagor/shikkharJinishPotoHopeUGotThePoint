<?php

namespace Modules\Billing\Http\Requests;

use App\Http\Requests\RootRequest;

class BillingCreateRequest extends RootRequest
{
    public function authorize()
    {
        return has_permission('billing.bill.add');
    }

    public function rules()
    {
        return [
            'manager_id' => 'required',
            'project_id' => 'required',
            'title' => 'required',
            'site_id' => 'required',
            'office_id' => 'required',
            'total' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
