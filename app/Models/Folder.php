<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function folders(): HasMany
    {
        return $this->hasMany(self::class);
    }

    public function childrenFolders(): HasMany
    {
        return $this->folders()->with('folders');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}
