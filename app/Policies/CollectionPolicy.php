<?php

namespace App\Policies;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CollectionPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Collection $collection): Response
    {
        return $user->id == $collection->user_id
        ? Response::allow()
        : Response::deny('You do not own this collection.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Collection $collection): Response
    {
        return $user->id == $collection->user_id
        ? Response::allow()
        : Response::deny('You do not own this collection.');
    }

}
