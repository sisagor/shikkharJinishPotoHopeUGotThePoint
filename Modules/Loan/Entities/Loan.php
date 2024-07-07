<?php

namespace Modules\Loan\Entities;

use App\Models\RootModel;
use App\Common\Documentable;
use App\Common\CascadeSoftDeletes;
use Modules\Branch\Entities\Branch;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;


class Loan extends RootModel
{
    use Documentable, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'loans';

    const LOAN_STATUS_PENDING = "pending";
    const LOAN_STATUS_PROCESSING = "processing";
    const LOAN_STATUS_APPROVED = "approved";
    const LOAN_STATUS_RELEASED = "released";
    const LOAN_STATUS_REJECTED = "rejected";

    const TYPE_LOAN = "loan";
    const TYPE_SALARY_ADVANCE = "advance_salary";


    //protected $cascadeDeletes = ['user'];

    protected $fillable = [
        'id', 'com_id', 'branch_id', 'employee_id', 'type', 'interest_percent', 'loan_amount', 'installments', 'installment_amount',
        'paid_installment', 'paid_installment_amount', 'is_paid', 'status'
    ];

    function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }

    function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }


    function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function scopePending($query)
    {
        return $query->where('status', self::LOAN_STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::LOAN_STATUS_APPROVED);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', self::LOAN_STATUS_PROCESSING);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::LOAN_STATUS_REJECTED);
    }

    public function scopeReleased($query)
    {
        return $query->where('status', self::LOAN_STATUS_RELEASED);
    }

}
