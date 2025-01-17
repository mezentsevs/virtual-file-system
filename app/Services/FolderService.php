<?php

namespace App\Services;

use App\Dtos\FolderCreateDto;
use App\Models\Folder;

class FolderService
{
    public function create(FolderCreateDto $dto): Folder
    {
        $folder = new Folder;

        $folder->user_id = $dto->userId;
        $folder->folder_id = $dto->folderId;
        $folder->name = $dto->name;

        $folder->save();

        return $folder;
    }
}
