<?php

namespace App\Policies\Blogs;

use App\Models\User;

class PostCategoryPolicy extends \App\Policies\Query
{
    /**
     * Determine whether the ProjectList can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->cek($user->id, 'viewAny ProjectList');
    }

    /**
     * Determine whether the ProjectList can view the model.
     */
    public function view(User $user): bool
    {
        return $this->cek($user->id, 'view ProjectList');
    }

    /**
     * Determine whether the ProjectList can create models.
     */
    public function create(User $user): bool
    {
        return $this->cek($user->id, 'create ProjectList');
    }

    /**
     * Determine whether the ProjectList can update the model.
     */
    public function update(User $user): bool
    {
        return $this->cek($user->id, 'update ProjectList');
    }

    /**
     * Determine whether the ProjectList can delete the model.
     */
    public function delete(User $user): bool
    {
        return $this->cek($user->id, 'delete ProjectList');
    }
}
