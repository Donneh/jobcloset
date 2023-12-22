<?php

namespace App\Policies;

use App\Models\AdyenSettings;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdyenSettingsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->id() === auth()->user()->tenant->owner_id;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AdyenSettings $adyenSettings): bool
    {
        return auth()->id() === auth()->user()->tenant->owner_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->id() === auth()->user()->tenant->owner_id;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AdyenSettings $adyenSettings): bool
    {
        return auth()->id() === auth()->user()->tenant->owner_id;
    }
}
