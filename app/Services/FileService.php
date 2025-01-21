<?php

namespace App\Services;

use App\Dtos\FileUpdateDto;
use App\Models\File;

class FileService
{
    public function update(FileUpdateDto $dto): File
    {
        $file = $dto->file;

        $file->name = $dto->name;
        $file->content = $dto->content;
        $file->size = strlen($dto->content);

        $file->save();

        return $file;
    }
}
