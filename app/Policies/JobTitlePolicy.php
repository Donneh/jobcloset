<?php

namespace App\Policies;

use App\Models\JobTitle;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class JobTitlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->hasPermissionTo('view job titles')
            ? Response::allow()
            : Response::deny('You do not have permission to view job titles.');
    }

    public function view(User $user, JobTitle $jobTitle): Response
    {
        return $user->hasPermissionTo('view job titles')
            ? Response::allow()
            : Response::deny('You do not have permission to view job titles.');
    }

    public function create(User $user): Response
    {
        return $user->hasPermissionTo('create job titles')
            ? Response::allow()
            : Response::deny('You do not have permission to create job titles.');
    }

    public function update(User $user, JobTitle $jobTitle): Response
    {
        return $user->hasPermissionTo('edit job titles')
            ? Response::allow()
            : Response::deny('You do not have permission to edit job titles.');
    }

    public function delete(User $user, JobTitle $jobTitle): Response
    {
        return $user->hasPermissionTo('delete job titles')
            ? Response::allow()
            : Response::deny('You do not have permission to delete job titles.');
    }
}
