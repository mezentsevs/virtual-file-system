<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}
