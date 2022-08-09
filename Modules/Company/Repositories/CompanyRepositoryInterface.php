<?php

namespace Modules\Company\Repositories;


use Illuminate\Http\Request;
use App\Repositories\RootRepository;
use Modules\Company\Entities\Company;


interface CompanyRepositoryInterface extends RootRepository
{
    public function updateProfile(Request $request, Company $company);

    public function updateSettings(Request $request);
}
