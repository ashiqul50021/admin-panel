<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    private $tag;

    public function __construct()
    {
        $this->tag = 'categories';
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Permission::where('role_id', $user->role->id)
                         ->where('name', "{$this->tag}_view")
                         ->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return Permission::where('role_id', $user->role->id)
                         ->where('name', "{$this->tag}_view")
                         ->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Permission::where('role_id', $user->role->id)
                         ->where('name', "{$this->tag}_create")
                         ->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return Permission::where('role_id', $user->role->id)
                         ->where('name', "{$this->tag}_update")
                         ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return Permission::where('role_id', $user->role->id)
                         ->where('name', "{$this->tag}_delete")
                         ->exists();
    }


}
