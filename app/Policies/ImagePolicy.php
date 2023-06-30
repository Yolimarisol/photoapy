<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ImagePolicy
{

    public function update(User $user, Image $image): Response
    {
        return $user->id == $image->user_id
        ? Response::allow()
        : Response::deny('You do not own this image.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Image $image): Response
    {
        return $user->id == $image->user_id
        ? Response::allow()
        : Response::deny('You do not own this image.');
    }
}
