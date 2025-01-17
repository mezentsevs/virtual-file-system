<?php

namespace App\Dtos;

use App\Interfaces\DtoInterface;
use App\Models\Folder;

class FolderUpdateDto implements DtoInterface
{
    public Folder $folder;

    public string $name;

    public function toArray(): array
    {
        return [
            'folder' => $this->folder,
            'name' => $this->name,
        ];
    }
}
