<?php

namespace Modules\Organization\Repositories;

use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;
use Modules\Organization\Entities\Designation;

class DesignationRepository extends EloquentRepository implements DesignationRepositoryInterface
{
    public $model;

    public function __construct(Designation $designation)
    {
        $this->model = $designation;
    }

    public function all()
    {
        return  $this->model->commonScope()->with('department:id,name');
    }

}
