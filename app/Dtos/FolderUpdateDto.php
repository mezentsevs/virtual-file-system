<?php

namespace App\Dtos;

use App\Interfaces\Dto;
use App\Models\Folder;

class FolderUpdateDto implements Dto
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
