<?php

namespace App\Dtos;

use App\Interfaces\DtoInterface;
use App\Models\File;

class FileUpdateDto implements DtoInterface
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
