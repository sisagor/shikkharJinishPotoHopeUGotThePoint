<?php

namespace Modules\Loan\Http\Requests;

use App\Http\Requests\RootRequest;


class LoanCreateRequest extends RootRequest
{
    public function authorize()
    {
        return ! is_admin_group();
    }

    public function rules()
    {
        return [
            'employee_id' => 'required',
            'type' => 'required',
            'loan_amount' => 'required|numeric',
            'installments' => 'required|numeric',
            'installment_amount' => 'required|numeric',
            'details' => 'required',
            'status' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
