<?php

namespace App\Models;

use Database\Factories\FileFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int $folder_id
 * @property string $name
 * @property string|null $content
 * @property int|null $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Folder $folder
 * @method static FileFactory factory($count = null, $state = [])
 * @method static Builder<static>|File newModelQuery()
 * @method static Builder<static>|File newQuery()
 * @method static Builder<static>|File query()
 * @method static Builder<static>|File whereContent($value)
 * @method static Builder<static>|File whereCreatedAt($value)
 * @method static Builder<static>|File whereFolderId($value)
 * @method static Builder<static>|File whereId($value)
 * @method static Builder<static>|File whereName($value)
 * @method static Builder<static>|File whereSize($value)
 * @method static Builder<static>|File whereUpdatedAt($value)
 */
class File extends Model
{
    /** @use HasFactory<FileFactory> */
    use HasFactory;

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}
