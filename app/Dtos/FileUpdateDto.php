<?php

namespace App\Dtos;

use App\Interfaces\Dto;
use App\Models\File;

class FileUpdateDto implements Dto
{
    public File $file;

    public string $name;

    public string $content;

    public function toArray(): array
    {
        return [
            'file' => $this->file,
            'name' => $this->name,
            'content' => $this->content,
        ];
    }
}
