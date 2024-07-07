<?php

namespace Modules\Organization\Repositories;

use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;
use Modules\Organization\Entities\Department;

class DepartmentRepository extends EloquentRepository implements DepartmentRepositoryInterface
{
    public $model;

    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    public function all()
    {
        return  $this->model->commonScope();
    }

}
