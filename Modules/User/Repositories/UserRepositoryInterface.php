<?php

namespace Modules\User\Repositories;

use App\Models\User;
use App\Repositories\RootRepository;
use Illuminate\Http\Request;
use Modules\User\Entities\Profile;

interface UserRepositoryInterface extends RootRepository
{
    public function updateUserProfile(Request $request, Profile $profile);

    public function userPasswordUpdate(Request $request, User $user);
}
