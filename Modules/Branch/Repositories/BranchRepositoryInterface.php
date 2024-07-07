<?php

namespace Modules\Branch\Repositories;


use Illuminate\Http\Request;
use Modules\Branch\Entities\Branch;
use App\Repositories\RootRepository;


interface BranchRepositoryInterface extends RootRepository
{
    public function updateProfile(Request $request, Branch $branch);
}
