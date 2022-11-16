<?php

namespace Modules\Organization\Repositories;

use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;
use Modules\Organization\Entities\Department;

class OrganizationRepository extends EloquentRepository implements OrganizationRepositoryInterface
{
    public $model;

    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    //delete Department
    public function destroy($model): bool
    {
        try {

            $model->forceDelete();

        } catch (\Exception $exception) {
            Log::error('Delete Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


}
