<?php

namespace App\Policies\Blogs;

use App\Models\User;

class PostPolicy extends \App\Policies\Query
{
    /**
     * Determine whether the Customer can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->cek($user->id, 'viewAny Customer');
    }

    /**
     * Determine whether the Customer can view the model.
     */
    public function view(User $user): bool
    {
        return $this->cek($user->id, 'view Customer');
    }

    /**
     * Determine whether the Customer can create models.
     */
    public function create(User $user): bool
    {
        return $this->cek($user->id, 'create Customer');
    }

    /**
     * Determine whether the Customer can update the model.
     */
    public function update(User $user): bool
    {
        return $this->cek($user->id, 'update Customer');
    }

    /**
     * Determine whether the Customer can delete the model.
     */
    public function delete(User $user): bool
    {
        return $this->cek($user->id, 'delete Customer');
    }
}
