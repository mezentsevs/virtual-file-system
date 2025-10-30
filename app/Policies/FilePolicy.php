<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;

class FilePolicy
{
    public function viewAny(): bool
    {
        return auth()->check();
    }

    public function create(): bool
    {
        return auth()->check();
    }

    public function update(User $user, File $file): bool
    {
        return $user->id === $file->folder->user_id;
    }

    public function delete(User $user, File $file): bool
    {
        return $user->id === $file->folder->user_id;
    }
}
