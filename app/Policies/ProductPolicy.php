<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasPermissionTo('view products')
            ? Response::allow()
            : Response::deny('You do not have permission to view products.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): Response
    {
        return $user->hasPermissionTo('view products')
            ? Response::allow()
            : Response::deny('You do not have permission to view products.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('create products')
            ? Response::allow()
            : Response::deny('You do not have permission to create products.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): Response
    {
        return $user->hasPermissionTo('edit products')
            ? Response::allow()
            : Response::deny('You do not have permission to edit products.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): Response
    {
        return $user->hasPermissionTo('delete products')
            ? Response::allow()
            : Response::deny('You do not have permission to delete products.');
    }
}
