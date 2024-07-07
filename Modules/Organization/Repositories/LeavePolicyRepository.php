<?php

namespace Modules\Organization\Repositories;

use App\Repositories\EloquentRepository;
use Modules\Organization\Entities\LeavePolicy;
use Modules\Organization\Repositories\LeavePolicyRepositoryInterface;

class LeavePolicyRepository extends EloquentRepository implements LeavePolicyRepositoryInterface
{
    public $model;

    public function __construct(LeavePolicy $leavePolicy)
    {
        $this->model = $leavePolicy;
    }

    public function all()
    {
        return  $this->model->commonScope();
    }

}
