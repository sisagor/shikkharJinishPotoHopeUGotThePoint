<?php

namespace Modules\Loan\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Loan\Entities\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;


class LoanRepository extends EloquentRepository implements LoanRepositoryInterface
{
    public $model;

    public function __construct(Loan $branch)
    {
        $this->model = $branch;
    }

    /*Get all branches*/
    public function pending(Request $request)
    {
        return $this->model->mine()->pending()->with('employee:name,id,employee_index');
    }


    /*Store Branch*/
    public function store(Request $request): bool
    {
        try {

            $this->model->create([
                'employee_id' => $request->get('employee_id'),
                'type' => $request->get('type'),
                'interest_percent' => ($request->get('interest_percent') ?? 0),
                'loan_amount' => $request->get('loan_amount'),
                'installments' => $request->get('installments'),
                'installment_amount' => $this->getInstallmentAmount($request),
                'details' => $request->get('details'),
                'status' => $request->get('status'),
            ]);


        } catch (\Exception $e) {

            Log::error("Loan create Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }

    /*Store Branch*/
    public function update(Request $request, $loan): bool
    {
        try {

            $this->model->find($loan);

            $this->model->update([
                'employee_id' => $request->get('employee_id'),
                'type' => $request->get('type'),
                'interest_percent' => ($request->get('interest_percent') ?? 0),
                'loan_amount' => $request->get('loan_amount'),
                'installments' => $request->get('installments'),
                'installment_amount' => $this->getInstallmentAmount($request),
                'details' => $request->get('details'),
                'status' => $request->get('status'),
            ]);


        } catch (\Exception $e) {

            Log::error("Loan update Failed");
            Log::info(get_exception_message($e));

            return false;
        }

        return true;
    }





    /*Delete branch */
    public function destroy($model): bool
    {
        try {

            DB::beginTransaction();

            $model->user->forceDelete();
            $model->forceDelete();

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Delete Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;

    }


    /**
     * this function will return calculated installment amount
     * @param $request
     * @return float|int
     */
    protected function getInstallmentAmount($request): float|int
    {
        if($request->get('type') == Loan::TYPE_LOAN){
            $percent = ($request->get('loan_amount') * $request->get('interest_percent') / 100);
            $installmentAmount = ($request->get('loan_amount') + $percent / $request->get('installments'));
        }
        else
        {
            $installmentAmount = ($request->get('loan_amount') / $request->get('installments'));
        }

        return $installmentAmount;
    }


}
