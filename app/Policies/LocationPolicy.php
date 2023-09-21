<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LocationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->hasPermissionTo('view locations')
            ? Response::allow()
            : Response::deny('You do not have permission to view locations.');
    }

    public function view(User $user, Location $location): Response
    {
        return $user->hasPermissionTo('view locations')
            ? Response::allow()
            : Response::deny('You do not have permission to view locations.');
    }

    public function create(User $user): Response
    {
        return $user->hasPermissionTo('create locations')
            ? Response::allow()
            : Response::deny('You do not have permission to create locations.');
    }

    public function update(User $user, Location $location): Response
    {
        return $user->hasPermissionTo('edit locations')
            ? Response::allow()
            : Response::deny('You do not have permission to edit locations.');
    }

    public function delete(User $user, Location $location): Response
    {
        return $user->hasPermissionTo('delete locations')
            ? Response::allow()
            : Response::deny('You do not have permission to delete locations.');
    }
}
