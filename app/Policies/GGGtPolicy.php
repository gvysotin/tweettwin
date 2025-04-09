<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GGGtPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Idea $idea): bool
    {
        return ((bool) $user->is_admin || $user->id === $idea->user_id); // только администратор или владелец
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Idea $idea): bool
    {
        return ((bool) $user->is_admin || $user->id === $idea->user_id); // только администратор или владелец
    }

}
