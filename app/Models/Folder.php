<?php

namespace App\Models;

use Database\Factories\FolderFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Folder
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $folder_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Folder> $childrenFolders
 * @property-read int|null $children_folders_count
 * @property-read Collection<int, File> $files
 * @property-read int|null $files_count
 * @property-read Collection<int, Folder> $folders
 * @property-read int|null $folders_count
 * @property-read Folder $folder
 * @property-read User $user
 * @method static FolderFactory factory($count = null, $state = [])
 * @method static Builder<static>|Folder newModelQuery()
 * @method static Builder<static>|Folder newQuery()
 * @method static Builder<static>|Folder query()
 * @method static Builder<static>|Folder whereCreatedAt($value)
 * @method static Builder<static>|Folder whereFolderId($value)
 * @method static Builder<static>|Folder whereId($value)
 * @method static Builder<static>|Folder whereName($value)
 * @method static Builder<static>|Folder whereUpdatedAt($value)
 * @method static Builder<static>|Folder whereUserId($value)
 */
class Folder extends Model
{
    /** @use HasFactory<FolderFactory> */
    use HasFactory;

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

    public function folder(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}
