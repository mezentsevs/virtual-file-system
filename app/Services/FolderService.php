<?php

namespace App\Services;

use App\Dtos\FolderCreateDto;
use App\Dtos\FolderUpdateDto;
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

    public function update(FolderUpdateDto $dto): Folder
    {
        $folder = $dto->folder;

        $folder->name = $dto->name;

        $folder->save();

        return $folder;
    }

    public function delete(Folder $folder): Folder
    {
        $folder->delete();

        return $folder;
    }
}
