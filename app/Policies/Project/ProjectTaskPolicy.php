<?php

namespace App\Policies\Project;

use App\Models\User;

class ProjectTaskPolicy extends \App\Policies\Query
{
    /**
     * Determine whether the ProjectTask can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->cek($user->id, 'viewAny ProjectTask');
    }

    /**
     * Determine whether the ProjectTask can view the model.
     */
    public function view(User $user): bool
    {
        return $this->cek($user->id, 'view ProjectTask');
    }

    /**
     * Determine whether the ProjectTask can create models.
     */
    public function create(User $user): bool
    {
        return $this->cek($user->id, 'create ProjectTask');
    }

    /**
     * Determine whether the ProjectTask can update the model.
     */
    public function update(User $user): bool
    {
        return $this->cek($user->id, 'update ProjectTask');
    }

    /**
     * Determine whether the ProjectTask can delete the model.
     */
    public function delete(User $user): bool
    {
        return $this->cek($user->id, 'delete ProjectTask');
    }
}
