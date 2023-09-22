<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->hasPermissionTo('view departments')
            ? Response::allow()
            : Response::deny('You do not have permission to view departments.');
    }

    public function view(User $user, Department $department): Response
    {
        return $user->hasPermissionTo('view departments')
            ? Response::allow()
            : Response::deny('You do not have permission to view departments.');
    }

    public function create(User $user): Response
    {
        return $user->hasPermissionTo('create departments')
            ? Response::allow()
            : Response::deny('You do not have permission to create departments.');
    }

    public function update(User $user, Department $department): Response
    {
        return $user->hasPermissionTo('edit departments')
            ? Response::allow()
            : Response::deny('You do not have permission to edit departments.');
    }

    public function delete(User $user, Department $department): Response
    {
        return $user->hasPermissionTo('delete departments')
            ? Response::allow()
            : Response::deny('You do not have permission to delete departments.');
    }
}
