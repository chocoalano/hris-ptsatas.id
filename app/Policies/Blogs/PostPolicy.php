<?php

namespace App\Policies\Blogs;

use App\Models\User;

class PostPolicy extends \App\Policies\Query
{
    /**
     * Determine whether the BlogPost can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->cek($user->id, 'viewAny BlogPost');
    }

    /**
     * Determine whether the BlogPost can view the model.
     */
    public function view(User $user): bool
    {
        return $this->cek($user->id, 'view BlogPost');
    }

    /**
     * Determine whether the BlogPost can create models.
     */
    public function create(User $user): bool
    {
        return $this->cek($user->id, 'create BlogPost');
    }

    /**
     * Determine whether the BlogPost can update the model.
     */
    public function update(User $user): bool
    {
        return $this->cek($user->id, 'update BlogPost');
    }

    /**
     * Determine whether the BlogPost can delete the model.
     */
    public function delete(User $user): bool
    {
        return $this->cek($user->id, 'delete BlogPost');
    }
}
