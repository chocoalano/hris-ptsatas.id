<?php

namespace App\Policies\Blogs;

use App\Models\User;

class PostCategoryPolicy extends \App\Policies\Query
{
    /**
     * Determine whether the BlogCategory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->cek($user->id, 'viewAny BlogCategory');
    }

    /**
     * Determine whether the BlogCategory can view the model.
     */
    public function view(User $user): bool
    {
        return $this->cek($user->id, 'view BlogCategory');
    }

    /**
     * Determine whether the BlogCategory can create models.
     */
    public function create(User $user): bool
    {
        return $this->cek($user->id, 'create BlogCategory');
    }

    /**
     * Determine whether the BlogCategory can update the model.
     */
    public function update(User $user): bool
    {
        return $this->cek($user->id, 'update BlogCategory');
    }

    /**
     * Determine whether the BlogCategory can delete the model.
     */
    public function delete(User $user): bool
    {
        return $this->cek($user->id, 'delete BlogCategory');
    }
}
