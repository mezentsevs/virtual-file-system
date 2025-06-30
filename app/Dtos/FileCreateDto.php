<?php

namespace App\Dtos;

use App\Interfaces\Dto;

class FileCreateDto implements Dto
{
    public int $folderId;

    public string $name;

    public string $content;

    public function toArray(): array
    {
        return [
            'folder_id' => $this->folderId,
            'name' => $this->name,
            'content' => $this->content,
        ];
    }
}
