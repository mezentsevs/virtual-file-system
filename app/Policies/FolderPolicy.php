<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;

class FolderPolicy
{
    public function viewAny(): bool
    {
        return auth()->check();

    }

    public function view(User $user, Folder $folder): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Folder $folder): bool
    {
        return $user->id === $folder->user_id;
    }

    public function delete(User $user, Folder $folder): bool
    {
        return $user->id === $folder->user_id;
    }

    public function restore(User $user, Folder $folder): bool
    {
        return false;
    }

    public function forceDelete(User $user, Folder $folder): bool
    {
        return false;
    }
}
