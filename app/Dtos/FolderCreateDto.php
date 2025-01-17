<?php

namespace App\Dtos;

use App\Interfaces\DtoInterface;

class FolderCreateDto implements DtoInterface
{
    public int $userId;

    public ?int $folderId;

    public string $name;

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'folder_id' => $this->folderId,
            'name' => $this->name,
        ];
    }
}
