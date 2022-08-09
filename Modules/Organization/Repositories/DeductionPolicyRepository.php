<?php

namespace Modules\Organization\Repositories;

use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;
use Modules\Organization\Entities\DeductionPolicy;

class DeductionPolicyRepository extends EloquentRepository implements DeductionPolicyRepositoryInterface
{
    public $model;

    public function __construct(DeductionPolicy $deductionPolicy)
    {
        $this->model = $deductionPolicy;
    }

    public function all()
    {
        return  $this->model->commonScope();
    }

}
