<?php

namespace App\Policies\Asset;

use App\Models\User;

class DocumentPolicy extends \App\Policies\Query
{
    /**
     * Determine whether the Document can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->cek($user->id, 'viewAny Document');
    }

    /**
     * Determine whether the Document can view the model.
     */
    public function view(User $user): bool
    {
        return $this->cek($user->id, 'view Document');
    }

    /**
     * Determine whether the Document can create models.
     */
    public function create(User $user): bool
    {
        return $this->cek($user->id, 'create Document');
    }

    /**
     * Determine whether the Document can update the model.
     */
    public function update(User $user): bool
    {
        return $this->cek($user->id, 'update Document');
    }

    /**
     * Determine whether the Document can delete the model.
     */
    public function delete(User $user): bool
    {
        return $this->cek($user->id, 'delete Document');
    }
}
