<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanySettingsPolicy
{
    use HandlesAuthorization;

    public function view(User $user): Response
    {
        return $user->hasPermissionTo('view company settings')
            ? Response::allow()
            : Response::deny('You do not have permission to view company settings.');
    }
}
