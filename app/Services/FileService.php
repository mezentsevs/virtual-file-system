<?php

namespace App\Services;

use App\Dtos\FileCreateDto;
use App\Dtos\FileUpdateDto;
use App\Models\File;

class FileService
{
    public function create(FileCreateDto $dto): File
    {
        $file = new File();

        $file->folder_id = $dto->folderId;
        $file->name = $dto->name;
        $file->content = $dto->content;
        $file->size = strlen($dto->content);

        $file->save();

        return $file;
    }

    public function update(FileUpdateDto $dto): File
    {
        $file = $dto->file;

        $file->name = $dto->name;
        $file->content = $dto->content;
        $file->size = strlen($dto->content);

        $file->save();

        return $file;
    }

    public function delete(File $file): File
    {
        $file->delete();

        return $file;
    }
}
